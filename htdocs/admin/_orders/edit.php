<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{

}
else
{
    $statement = $database->prepare("SELECT `oid`, `odate`, `cname`, `ctel`, `caddr`, `orders`.`pid`, `pname`, `pcost`, `oqty`, `ocost`, `ostatus`, `odeliverdate` FROM `orders` LEFT JOIN `product` ON `orders`.`pid` = `product`.`pid` LEFT JOIN `customer` ON `orders`.`cid` = `customer`.`cid` WHERE `oid` = ?");
    $statement->bind_param("i", $_GET["id"]);
    $statement->execute();
    
    $result = $statement->get_result();
    $order = $result->fetch_assoc();

    $statement = $database->prepare("SELECT `prodmat`.`mid`, `mname`, `munit`, `mqty`, `mrqty`, `mreorderqty` FROM `orders` CROSS JOIN `prodmat` ON `orders`.`pid` = `prodmat`.`pid` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid` WHERE `oid` = ?");
    $statement->bind_param("i", $_GET["id"]);
    $statement->execute();
    
    $result = $statement->get_result();
    $materials = $result->fetch_all(MYSQLI_ASSOC);
}

var_dump($materials);
render_page("/admin/_orders/edit.tpl.php", "Update Order", compact("order", "materials", "error_messages"));
