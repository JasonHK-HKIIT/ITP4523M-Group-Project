<?php

$result = $database->query("SELECT `oid`, `odate`, `cname`, `pname`, `oqty`, `ocost`, `ostatus`, `odeliverdate` FROM `orders` LEFT JOIN `product` ON `orders`.`pid` = `product`.`pid` LEFT JOIN `customer` ON `orders`.`cid` = `customer`.`cid`");
$orders = $result->fetch_all(MYSQLI_ASSOC);

render_page("/admin/_orders/list.tpl.php", "Orders", compact("orders"),
    extra_head: ['<script src="/assets/sortable.min.js" async defer></script>']);
