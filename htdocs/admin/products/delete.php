<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$statement = $database->prepare("SELECT `pid`, `pname` FROM `product` WHERE `pid` = ?");
$statement->execute([$_GET["id"]]);
$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);
    render_error_page("Product Not Found", "The requested product does not exist.");
    exit;
}

$product = $result->fetch_assoc();
render_page("/admin/products/delete.tpl.php", "Delete Product", compact("product"), "warning");
