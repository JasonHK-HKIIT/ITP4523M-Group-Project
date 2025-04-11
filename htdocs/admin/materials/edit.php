<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$action = $_GET["action"];
if ($action === "edit")
{
    $statement = $database->prepare("SELECT `mid`, `mname`, `mqty`, `mrqty`, `munit`, `mreorderqty` FROM `material` WHERE `mid` = ?");
    $statement->execute([$_GET["id"]]);
    $result = $statement->get_result();
    $material = $result->fetch_assoc();
}

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/materials/edit.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$page_title = (($action === "edit") ? "Edit" : "New") . " Material";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
