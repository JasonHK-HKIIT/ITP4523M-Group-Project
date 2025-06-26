<?php

$order = ["id" => 1];

$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/_navbar.tpl.php";
$navbar_theme = "warning";

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/admin/orders/delete.tpl.php";
$page_title = "Delete Order";
require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
