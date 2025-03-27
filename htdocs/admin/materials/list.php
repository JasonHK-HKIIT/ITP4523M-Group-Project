<?php

$materials = array(
    array("id" => 1, "name" => "Rubber"),
    array("id" => 1, "name" => "Rubber"),
    array("id" => 1, "name" => "Rubber"),
);

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/materials/list.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$page_title = "Materials";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
