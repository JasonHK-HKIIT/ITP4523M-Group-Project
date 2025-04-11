<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT * FROM `product`");
$statement->execute();
$result = $statement->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/products.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/_navbar.tpl.php";
$page_title = "Products";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
