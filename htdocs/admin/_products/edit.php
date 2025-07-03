<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

const PNAME_LEN = 255;
const PDESC_LEN = 65535;

$action = $_GET["action"];

$result = $database->query("SELECT `mid`, `mname`, `munit` FROM `material`");;
$select_materials = $result->fetch_all(MYSQLI_ASSOC);

$product = [];
$materials = [];
$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if ((!empty($_POST["pname"]) && (mb_strlen($_POST["pname"]) <= PNAME_LEN))
        && (empty($_POST["pdesc"]) || (mb_strlen($_POST["pdesc"]) <= PDESC_LEN))
        && (is_numeric(@$_POST["pcost"]) && ($_POST["pcost"] >= 0.01))
        && ((($action === "edit") && empty($_FILES["image"]["tmp_name"])) || (!empty($_FILES["image"]["tmp_name"]) && is_jpeg($_FILES["image"]["tmp_name"])))
        && ((is_array(@$_POST["mid"]) && is_array(@$_POST["pmqty"])) && is_balanced($_POST["mid"], $_POST["pmqty"]) && is_materials($_POST["mid"]) && is_quantities($_POST["pmqty"])))
    {
        $database->begin_transaction();

        if ($action === "edit")
        {
            $statement = $database->prepare("UPDATE `product` SET `pname` = ?, `pdesc` = ?, `pcost` = ? WHERE `pid` = ?");
            $statement->bind_param("ssii", $_POST["pname"], $_POST["pdesc"], $_POST["pcost"], $_POST["pid"]);
            $statement->execute();

            $result = $statement->store_result();
            $pid = $_POST["pid"];
        }
        else
        {
            $statement = $database->prepare("INSERT INTO `product` (`pname`, `pdesc`, `pcost`) VALUES (?, ?, ?)");
            $statement->bind_param("ssi", $_POST["pname"], $_POST["pdesc"], $_POST["pcost"]);
            $statement->execute();

            $result = $statement->store_result();
            $pid = $statement->insert_id;
        }

        $statement = $database->prepare("DELETE FROM `prodmat` WHERE `pid` = ?");
        $statement->bind_param("i", $pid);
        $statement->execute();

        $materials = to_materials($_POST["mid"], $_POST["pmqty"]);
        foreach ($materials as $material)
        {
            $statement = $database->prepare("INSERT INTO `prodmat` (`pid`, `mid`, `pmqty`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE `pmqty` = ?");
            $statement->bind_param("iiii", $pid, $material["mid"], $material["pmqty"], $material["pmqty"]);
            $statement->execute();
        }

        if (!empty($_FILES["image"]["tmp_name"]))
        {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], sprintf($_SERVER["DOCUMENT_ROOT"] . "/assets/products/%d.jpg", $pid)))
            {
                $database->rollback();

                http_response_code(500);
                render_error_page("Upload Failed", "Failed to upload the image.");
                exit;
            }
        }

        $database->commit();
        header("Location: /admin/products.php", true, 307);
        exit;
    }
    else
    {
        http_response_code(400);

        $product["pname"] = $_POST["pname"];
        $product["pdesc"] = $_POST["pdesc"];
        $product["pcost"] = $_POST["pcost"];

        if (empty($_POST["pname"]))
        {
            $error_messages["pname"] = "This field is required";
        }
        else if (strlen($_POST["pname"]) > PNAME_LEN)
        {
            $error_messages["pname"] = "This field is too long";
        }

        if (!empty($_POST["pdesc"]) && (strlen($_POST["pdesc"]) > PDESC_LEN))
        {
            $error_messages["pdesc"] = "This field is too long";
        }

        if (empty($_POST["pcost"]) && ($_POST["pcost"] != 0))
        {
            $error_messages["pcost"] = "This field is required";
        }
        else if (!is_numeric($_POST["pcost"]))
        {
            $error_messages["pcost"] = "This field must be a number";
        }
        else if ($_POST["pcost"] <= 0)
        {
            $error_messages["pcost"] = "This field must be > 0";
        }

        if (($action !== "edit") && empty($_FILES["image"]["tmp_name"]))
        {
            $error_messages["image"] = "This field is required";
        }
        else if (!empty($_FILES["image"]["tmp_name"]) && !is_jpeg($_FILES["image"]["tmp_name"]))
        {
            $error_messages["image"] = "This field must be a JPEG image";
        }

        if (!(is_array(@$_POST["mid"]) && is_array(@$_POST["pmqty"])))
        {
            $error_messages["materials"] = "This field is required";
        }
        else if (!is_balanced($_POST["mid"], $_POST["pmqty"]) || !is_materials($_POST["mid"]))
        {
            $error_messages["materials"] = "Malformed materials list";
        }
        else if (!is_quantities($_POST["pmqty"]))
        {
            $error_messages["materials"] = "Quantities must be > 0";
            $materials = to_materials($_POST["mid"], $_POST["pmqty"]);
        }
        else
        {
            $materials = to_materials($_POST["mid"], $_POST["pmqty"]);
        }
    }
}

if ($action === "edit")
{
    $statement = $database->prepare("SELECT `pid`, `pname`, `pdesc`, `pcost` FROM `product` WHERE `pid` = ?");
    $statement->bind_param("i", $_GET["id"]);
    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows == 0)
    {
        http_response_code(404);
        render_error_page("Product Not Found", "The requested product does not exist.");
        exit;
    }

    $product = $result->fetch_assoc();

    $statement = $database->prepare("SELECT `pid`, `prodmat`.`mid`, `mname`, `pmqty`, `munit` FROM `prodmat` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid` WHERE `pid` = ?");
    $statement->bind_param("i", $product["pid"]);
    $statement->execute();
    $result = $statement->get_result();

    $materials = $result->fetch_all(MYSQLI_ASSOC);
}

render_page(
    "/admin/_products/edit.tpl.php", 
    (($action === "edit") ? "Edit" : "New") . " Product", 
    compact("action", "select_materials", "product", "materials", "error_messages"),
    extra_head: ['<script src="/assets/admin/products.edit.js" defer async></script>']);

function is_materials(array $mid): bool
{
    global $database;

    static $materials;
    if (!$materials)
    {
        $result = $database->query("SELECT `mid` FROM `material`");
        $materials = array_merge(...$result->fetch_all(MYSQLI_NUM));
    }

    return (array_intersect($mid, $materials) == $mid);
}

function is_quantities(array $pmqty): bool
{
    foreach ($pmqty as $qty)
    {
        if ($qty <= 0) { return false; }
    }

    return true;
}

function to_materials(array $mid, array $pmqty): array
{
    if (count($mid) != count($pmqty))
    {
        throw new Exception("Error Processing Request", 1);
    }

    $materials = [];
    for ($i = 0; $i < count($mid); $i++)
    {
        $materials[] = ["mid" => $mid[$i], "pmqty" => $pmqty[$i]];
    }

    return $materials;
}

function check_material()
{

}
