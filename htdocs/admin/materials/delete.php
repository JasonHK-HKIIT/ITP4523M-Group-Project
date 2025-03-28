<?php

$material = ["id" => 1, "name" => "Rubber"];

$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$navbar_theme = "warning";

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/materials/delete.tpl.php";
$page_title = "Delete Materials";
require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
