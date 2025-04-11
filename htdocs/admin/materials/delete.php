<?php

$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT `mid`, `mname` FROM `material` WHERE `mid` = ?");
$statement->execute([$_GET["id"]]);
$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);

    $error_title = "Material Not Found";
    $error_message = "The requested material does not exist.";

    $tpl = $_SERVER["DOCUMENT_ROOT"] . "/_error.tpl.php";
    $page_title = "Error";
    $navbar_theme = "danger";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");

    exit();
}

$material = $result->fetch_assoc();

$navbar_theme = "warning";

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/materials/delete.tpl.php";
$page_title = "Delete Material";
require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
