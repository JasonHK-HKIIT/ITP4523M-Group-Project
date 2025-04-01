<?php

$action = $_GET["action"];

$products = [
    ["id" => 1, "name" => "Toy Car", "unit_proce" => 50, "quantity" => 10],
    ["id" => 1, "name" => "Toy Car", "unit_proce" => 50, "quantity" => 10],
    ["id" => 1, "name" => "Toy Car", "unit_proce" => 50, "quantity" => 10],
];

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/cart/view.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/_navbar.tpl.php";
$page_title = "Cart";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
