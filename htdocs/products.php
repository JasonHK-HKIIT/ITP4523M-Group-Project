<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$statement = $database->prepare("SELECT `pid`, `pname`, `pdesc`, `pcost` FROM `product`");
$statement->execute();
$result = $statement->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

render_page("/products.tpl.php", "Products", ["products" => $products]);
