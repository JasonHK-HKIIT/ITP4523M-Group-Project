<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT `mid`, `mname` FROM `material` WHERE `mid` = ?");
$statement->execute([$_GET["id"]]);
$result = $statement->get_result();
$material = $result->fetch_assoc();

$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$navbar_theme = "warning";

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/materials/delete.tpl.php";
$page_title = "Delete Material";
require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
