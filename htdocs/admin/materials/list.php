<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT * FROM `material`");
$statement->execute();
$result = $statement->get_result();
$materials = $result->fetch_all(MYSQLI_ASSOC);

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/materials/list.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$page_title = "Materials";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
