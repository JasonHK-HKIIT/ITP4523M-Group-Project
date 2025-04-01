<?php

$products = [
    ["name" => "Toy Car", "total_orders" => 100, "total_sales" => 10000],
    ["name" => "Toy Car", "total_orders" => 100, "total_sales" => 10000],
    ["name" => "Toy Car", "total_orders" => 100, "total_sales" => 10000],
    ["name" => "Toy Car", "total_orders" => 100, "total_sales" => 10000],
];

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/reports.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$page_title = "Reports";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
