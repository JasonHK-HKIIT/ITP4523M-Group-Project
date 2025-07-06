<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$sort = $_GET["sort"] ?? "magic";

$query = "SELECT * FROM (SELECT *, MIN(`pqty`) AS `pqty_min` FROM (SELECT `product`.`pid`, `pname`, `pdesc`, `pcost`, FLOOR((`mqty` - `mrqty`) / `pmqty`) AS `pqty` FROM `product` CROSS JOIN `prodmat` ON `product`.`pid` = `prodmat`.`pid` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid`) `p` GROUP BY `pid` HAVING `pqty_min` > 0) `pp`";
$query .= match ($sort)
{
    "magic" => "",
    "price_asc" => " ORDER BY `pcost` ASC",
    "price_desc" => " ORDER BY `pcost` DESC",
    "name_asc" => " ORDER BY `pname` ASC",
    "name_desc" => " ORDER BY `pname` DESC",
};

$result = $database->query($query);
echo $database->error;
$products = $result->fetch_all(MYSQLI_ASSOC);

render_page("/products.tpl.php", "Products", compact("products", "sort"));
