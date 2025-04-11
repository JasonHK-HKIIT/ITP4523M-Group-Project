<?php

$action = $_GET["action"];

var_dump($_POST);

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT `mid`, `mname`, `munit` FROM `material`");
$statement->execute();
$result = $statement->get_result();
$select_materials = $result->fetch_all(MYSQLI_ASSOC);

if ($action === "edit")
{
    $statement = $database->prepare("SELECT `pid`, `pname`, `pdesc`, `pcost` FROM `product` WHERE `pid` = ?");
    $statement->execute([$_GET["id"]]);
    $result = $statement->get_result();

    $product = $result->fetch_assoc();

    $statement = $database->prepare("SELECT `pid`, `prodmat`.`mid`, `mname`, `pmqty`, `munit` FROM `prodmat` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid` WHERE `pid` = ?");
    $statement->execute([$product["pid"]]);
    $result = $statement->get_result();

    $materials = $result->fetch_all(MYSQLI_ASSOC);
}
else
{
    $materials = [];
}

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/products/edit.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$page_title = (($action === "edit") ? "Edit" : "New") . " Product";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
