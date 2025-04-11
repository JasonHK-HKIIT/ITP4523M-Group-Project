<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$id = 1;

$statement = $database->prepare("SELECT `cid`, `cname`, `ctel`, `caddr`, `company` FROM `customer` WHERE `cid` = ?");
$statement->execute([$id]);
$result = $statement->get_result();
$client = $result->fetch_assoc();

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/profile.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/_navbar.tpl.php";
$page_title = "Profile";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
