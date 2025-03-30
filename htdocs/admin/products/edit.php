<?php

$action = $_GET["action"];

$materials = [
    ["id" => 1, "name" => "Rubber", "unit" => "Unit"],
    ["id" => 1, "name" => "Rubber", "unit" => "Unit"],
    ["id" => 1, "name" => "Rubber", "unit" => "Unit"],
];

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/products/edit.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$page_title = (($action === "edit") ? "Edit" : "New") . " Product";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
