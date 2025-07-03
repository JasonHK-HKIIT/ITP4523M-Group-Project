<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$error_messages = [];
$max_quantity = PHP_INT_MAX;

$pid = $_POST["pid"] ?? $_GET["pid"];
$statement = $database->prepare("SELECT *, MIN(`pqty`) AS `pqty` FROM (SELECT `product`.`pid`, `pname`, `pcost`, FLOOR((`mqty` - `mrqty`) / `pmqty`) AS `pqty` FROM `product` CROSS JOIN `prodmat` ON `product`.`pid` = `prodmat`.`pid` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid`) `p` WHERE `pid` = ? GROUP BY `pid` HAVING `pqty` > 0");
$statement->bind_param("i", $pid);
$statement->execute();

$result = $statement->get_result();
$product = $result->fetch_assoc();

$statement = $database->prepare("SELECT `caddr` FROM `customer` WHERE `cid` = ?");
$statement->bind_param("i", $_SESSION["user_id"]);
$statement->execute();

$result = $statement->get_result();
$client = $result->fetch_assoc();

$order = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    
}
else
{

}

render_page("/_orders/new.tpl.php", "New Order", compact("order", "product", "client", "error_messages"),
    extra_head: ['<script src="/assets/orders.new.js" defer async></script>']);
