<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$pid = $_POST["pid"] ?? $_GET["id"];
$statement = $database->prepare("SELECT `pid`, `pname` FROM `product` WHERE `pid` = ? LIMIT 1");
$statement->bind_param("i", $pid);
$statement->execute();

$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);
    render_error_page("Product Not Found", "The requested product does not exist.");
    exit;
}
$product = $result->fetch_assoc();

$statement = $database->prepare("SELECT `oid` FROM `orders` WHERE `pid` = ?");
$statement->bind_param("i", $pid);
$statement->execute();

$result = $statement->get_result();
if ($result->num_rows > 0)
{
    http_response_code(400);
    render_error_page("Product In Use", sprintf("Delete the %d order(s) ordered this product first before continue.", $result->num_rows));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if (empty($_POST["pid"]))
    {
        http_response_code(400);
        render_error_page("Invalid Request", "The request received was invalid.");
        exit;
    }

    $database->begin_transaction();
    try
    {
        $statement = $database->prepare("DELETE FROM `prodmat` WHERE `pid` = ?");
        $statement->bind_param("i", $_POST["pid"]);
        $statement->execute();

        $statement = $database->prepare("DELETE FROM `product` WHERE `pid` = ?");
        $statement->bind_param("i", $_POST["pid"]);
        $statement->execute();

        $statement->store_result();
        if ($statement->affected_rows == 0)
        {
            $database->rollback();
            http_response_code(500);
            render_error_page("Product Not Deleted", "The request failed due to unknown reasons.");
            exit;
        }
    }
    catch (mysqli_sql_exception $ex)
    {
        $database->rollback();
        http_response_code(500);
        render_error_page(sprintf("MySQL Error %d", $ex->getCode()), $ex->getMessage());
        exit;
    }
    
    $database->commit();
    header("Location: /admin/products.php", true, 303);
    exit;
}

render_page("/admin/_products/delete.tpl.php", "Delete Product", compact("product"), "warning");
