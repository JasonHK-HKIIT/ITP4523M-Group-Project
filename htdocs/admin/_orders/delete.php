<?php

$oid = $_POST["oid"] ?? $_GET["id"];
$statement = $database->prepare("SELECT `oid`, `ostatus` FROM `orders` WHERE `oid` = ? LIMIT 1");
$statement->bind_param("i", $oid);
$statement->execute();

$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);
    render_error_page("Order Not Found", "The requested order does not exist.");
    exit;
}
$order = $result->fetch_assoc();

render_page("/admin/_orders/delete.tpl.php", "Delete Order", compact("order"), "warning");
