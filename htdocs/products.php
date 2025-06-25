<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$result = $database->query("SELECT `pid`, `pname`, `pdesc`, `pcost` FROM `product`");
$products = $result->fetch_all(MYSQLI_ASSOC);

render_page("/products.tpl.php", "Products", ["products" => $products]);
