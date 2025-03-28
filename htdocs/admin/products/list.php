<?php

$products = array(
    array("id" => 1, "name" => "Toy Car"),
    array("id" => 1, "name" => "Toy Car"),
    array("id" => 1, "name" => "Toy Car"),
);

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/products/list.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$page_title = "Products";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
