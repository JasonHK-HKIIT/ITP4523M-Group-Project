<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$action = $_GET["action"];

$result = $database->query("SELECT `mid`, `mname`, `munit` FROM `material`");;
$select_materials = $result->fetch_all(MYSQLI_ASSOC);

$product = [];
$materials = [];

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
    $statement->execute([$product["pid"]]);
    $result = $statement->get_result();

    $materials = $result->fetch_all(MYSQLI_ASSOC);
}

render_page(
    "/admin/products/edit.tpl.php", 
    (($action === "edit") ? "Edit" : "New") . " Product", 
    compact("action", "select_materials", "product", "materials"));
