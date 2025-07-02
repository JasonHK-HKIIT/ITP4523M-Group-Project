<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$oid = $_POST["oid"] ?? $_GET["id"];
$statement = $database->prepare("SELECT `oid`, `ostatus` FROM `orders` WHERE `cid` = ? AND `oid` = ?");
$statement->bind_param("ii", $_SESSION["user_id"], $oid);
$statement->execute();

$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);
    render_error_page("Order Not Found", "The requested order does not exist.");
    exit;
}
$order = $result->fetch_assoc();

render_page("/_orders/delete.tpl.php", "Delete Order", compact("order"), "warning");
