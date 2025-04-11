<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT `pid`, `pname` FROM `product` WHERE `pid` = ?");
$statement->execute([$_GET["id"]]);
$result = $statement->get_result();
$product = $result->fetch_assoc();

$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$navbar_theme = "warning";

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/products/delete.tpl.php";
$page_title = "Delete Product";
require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
