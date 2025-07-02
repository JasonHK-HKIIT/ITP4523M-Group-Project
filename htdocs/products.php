<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$result = $database->query("SELECT *, MIN(`pqty`) AS `pqty` FROM (SELECT `product`.`pid`, `pname`, `pdesc`, `pcost`, FLOOR((`mqty` - `mrqty`) / `pmqty`) AS `pqty` FROM `product` CROSS JOIN `prodmat` ON `product`.`pid` = `prodmat`.`pid` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid`) `p` GROUP BY `pid` HAVING `pqty` > 0");
$products = $result->fetch_all(MYSQLI_ASSOC);

render_page("/products.tpl.php", "Products", ["products" => $products]);
