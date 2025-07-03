<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

ensure_logged_in();
ensure_staff();

$result = $database->query("SELECT `orders`.`pid`, `pname`, COUNT(*) AS `ocount`, SUM(`ocost`) AS `ocost` FROM `orders` LEFT JOIN `product` ON `orders`.`pid` = `product`.`pid` GROUP BY `orders`.`pid`");
$products = $result->fetch_all(MYSQLI_ASSOC);

$result = $database->query("SELECT `orders`.`cid`, `cname`, COUNT(*) AS `ocount`, SUM(`ocost`) AS `ocost` FROM `orders` LEFT JOIN `customer` ON `orders`.`cid` = `customer`.`cid` GROUP BY `orders`.`cid`");
$clients = $result->fetch_all(MYSQLI_ASSOC);

render_page("/admin/reports.tpl.php", "Reports", compact("products", "clients"),
    extra_head: ['<script src="/assets/sortable.min.js" async defer></script>']);
