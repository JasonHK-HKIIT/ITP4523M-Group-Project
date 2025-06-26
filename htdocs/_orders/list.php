<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT `oid`, `odate`, `pname`, `oqty`, `ocost`, `ostatus`, `odeliverdate` FROM `orders` LEFT JOIN `product` ON `orders`.`pid` = `product`.`pid` WHERE `orders`.`cid` = ?");
$statement->bind_param("i", $_SESSION["user_id"]);
$statement->execute();

$result = $statement->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

function render_date(string $time_string): string
{
    return date("Y-m-d", strtotime($time_string));
}

function render_order_status(int $status): string
{
    return match ($status)
    {
        0 => "Rejected",
        1 => "Open",
        2 => "Processing",
        3 => "Approved",
        4 => "Pending Delivery",
        5 => "Completed",
    };
}

$tpl = $_SERVER["DOCUMENT_ROOT"] . "/orders/list.tpl.php";
$navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . "/_navbar.tpl.php";
$page_title = "Orders";

require_once($_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php");
