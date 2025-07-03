<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$statement = $database->prepare("SELECT `oid`, `odate`, `pname`, `oqty`, `ocost`, `ostatus`, `odeliverdate` FROM `orders` LEFT JOIN `product` ON `orders`.`pid` = `product`.`pid` WHERE `orders`.`cid` = ?");
$statement->bind_param("i", $_SESSION["user_id"]);
$statement->execute();

$result = $statement->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

render_page("/_orders/list.tpl.php", "Orders", compact("orders"),
    extra_head: ['<script src="/assets/sortable.min.js" async defer></script>']);
