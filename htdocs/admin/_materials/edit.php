<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

const MNAME_LEN = 255;
const MUNIT_LEN = 20;

$action = $_GET["action"];

$material = [];
$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if ((!empty($_POST["mname"]) && (strlen($_POST["mname"]) <= MNAME_LEN))
        && ((($action === "edit") && empty($_FILES["image"]["tmp_name"])) || (!empty($_FILES["image"]["tmp_name"]) && is_jpeg($_FILES["image"]["tmp_name"])))
        && (!empty($_POST["munit"]) && (strlen($_POST["munit"]) <= MUNIT_LEN))
        && (ctype_digit(@$_POST["mqty"]) && ($_POST["mqty"] >= 0))
        && (ctype_digit(@$_POST["mrqty"]) && ($_POST["mrqty"] >= 0))
        && (ctype_digit(@$_POST["mreorderqty"]) && ($_POST["mreorderqty"] >= 0)))
    {
        $database->begin_transaction();

        if ($action === "edit")
        {
            $statement = $database->prepare("UPDATE `material` SET `mname` = ?, `munit` = ?, `mqty` = ?, `mrqty` = ?, `mreorderqty` = ? WHERE `mid` = ?");
            $statement->bind_param("ssiiii", $_POST["mname"], $_POST["munit"], $_POST["mqty"], $_POST["mrqty"], $_POST["mreorderqty"], $_POST["mid"]);
            $statement->execute();

            $result = $statement->store_result();
            $mid = $_POST["mid"];
        }
        else
        {
            $statement = $database->prepare("INSERT INTO `material` (`mname`, `munit`, `mqty`, `mrqty`, `mreorderqty`) VALUES (?, ?, ?, ?, ?)");
            $statement->bind_param("ssiii", $_POST["mname"], $_POST["munit"], $_POST["mqty"], $_POST["mrqty"], $_POST["mreorderqty"]);
            $statement->execute();

            $result = $statement->store_result();
            $mid = $statement->insert_id;
        }

        if (!empty($_FILES["image"]["tmp_name"]))
        {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], sprintf($_SERVER["DOCUMENT_ROOT"] . "/assets/materials/%d.jpg", $mid)))
            {
                $database->rollback();

                http_response_code(500);
                render_error_page("Upload Failed", "Failed to upload the image.");
                exit;
            }
        }
        
        $database->commit();
        header("Location: /admin/materials.php", true, 307);
        exit;
    }
    else
    {
        http_response_code(400);

        $material["mname"] = $_POST["mname"];
        $material["munit"] = $_POST["munit"];
        $material["mqty"] = $_POST["mqty"];
        $material["mrqty"] = $_POST["mrqty"];
        $material["mreorderqty"] = $_POST["mreorderqty"];

        if (empty($_POST["mname"]))
        {
            $error_messages["mname"] = "This field is required";
        }
        else if (mb_strlen($_POST["mname"]) > MNAME_LEN)
        {
            $error_messages["mname"] = "This field is too long";
        }

        if (($action !== "edit") && empty($_FILES["image"]["tmp_name"]))
        {
            $error_messages["image"] = "This field is required";
        }
        else if (!empty($_FILES["image"]["tmp_name"]) && !is_jpeg($_FILES["image"]["tmp_name"]))
        {
            $error_messages["image"] = "This field must be a JPEG image";
        }

        if (empty($_POST["munit"]))
        {
            $error_messages["munit"] = "This field is required";
        }
        else if (mb_strlen($_POST["munit"]) > MUNIT_LEN)
        {
            $error_messages["munit"] = "This field is too long";
        }

        if (empty($_POST["mqty"]) && ($_POST["mqty"] != 0))
        {
            $error_messages["mqty"] = "This field is required";
        }
        else if (!ctype_digit($_POST["mqty"]))
        {
            $error_messages["mqty"] = "This field must be a number";
        }
        else if ($_POST["mqty"] < 0)
        {
            $error_messages["mqty"] = "This field must be ≥ 0";
        }

        if (empty($_POST["mrqty"]) && ($_POST["mrqty"] != 0))
        {
            $error_messages["mrqty"] = "This field is required";
        }
        else if (!ctype_digit($_POST["mrqty"]))
        {
            $error_messages["mrqty"] = "This field must be a number";
        }
        else if ($_POST["mrqty"] < 0)
        {
            $error_messages["mrqty"] = "This field must be ≥ 0";
        }

        if (empty($_POST["mreorderqty"]) && ($_POST["mreorderqty"] != 0))
        {
            $error_messages["mreorderqty"] = "This field is required";
        }
        else if (!ctype_digit($_POST["mreorderqty"]))
        {
            $error_messages["mreorderqty"] = "This field must be a number";
        }
        else if ($_POST["mreorderqty"] < 0)
        {
            $error_messages["mreorderqty"] = "This field must be ≥ 0";
        }
    }
}
else
{
    if ($action === "edit")
    {
        $statement = $database->prepare("SELECT `mid`, `mname`, `munit`, `mqty`, `mrqty`, `mreorderqty` FROM `material` WHERE `mid` = ? LIMIT 1");
        $statement->bind_param("i", $_GET["id"]);
        $statement->execute();
        
        $result = $statement->get_result();
        $material = $result->fetch_assoc();
    }
}

render_page("/admin/_materials/edit.tpl.php",(($action === "edit") ? "Edit" : "New") . " Material", compact("action", "material", "error_messages"));
