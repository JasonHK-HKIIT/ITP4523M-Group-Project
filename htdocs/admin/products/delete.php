<?php

$product = ["id" => 1, "name" => "Toy Car"];

$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$navbar_theme = "warning";

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/products/delete.tpl.php";
$page_title = "Delete Product";
require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
