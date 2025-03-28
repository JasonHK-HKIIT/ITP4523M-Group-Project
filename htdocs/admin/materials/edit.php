<?php

$action = $_GET["action"];

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/materials/edit.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$page_title = (($action === "edit") ? "Edit" : "New") . " Material";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
