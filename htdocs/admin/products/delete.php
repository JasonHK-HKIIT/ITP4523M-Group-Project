<?php

$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT `pid`, `pname` FROM `product` WHERE `pid` = ?");
$statement->execute([$_GET["id"]]);
$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);

    $error_title = "Product Not Found";
    $error_message = "The requested product does not exist.";

    $tpl = $_SERVER["DOCUMENT_ROOT"] . "/_error.tpl.php";
    $page_title = "Error";
    $navbar_theme = "danger";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");

    exit();
}

$product = $result->fetch_assoc();

$navbar_theme = "warning";

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/products/delete.tpl.php";
$page_title = "Delete Product";
require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
