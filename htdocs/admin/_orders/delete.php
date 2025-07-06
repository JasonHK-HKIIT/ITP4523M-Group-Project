<?php

$oid = $_POST["oid"] ?? $_GET["id"];
$statement = $database->prepare("SELECT `oid`, `ostatus`, `cname` FROM `orders` LEFT JOIN `customer` ON `orders`.`cid` = `customer`.`cid` WHERE `oid` = ? LIMIT 1");
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

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if (empty($_POST["oid"]))
    {
        http_response_code(400);
        render_error_page("Invalid Request", "The request received was invalid.");
        exit;
    }

    $statement = $database->prepare("SELECT `prodmat`.`mid`, `oqty` * `pmqty` AS `omqty` FROM `orders` CROSS JOIN `prodmat` ON `orders`.`pid` = `prodmat`.`pid` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid` WHERE `oid` = ?");
    $statement->bind_param("i", $oid);
    $statement->execute();

    $result = $statement->get_result();
    $materials = $result->fetch_all(MYSQLI_ASSOC);

    $database->begin_transaction();
    try
    {
        if ($order["ostatus"] == ORDER_STATUS_ACCEPTED)
        {
            foreach ($materials as $material)
            {
                $statement = $database->prepare("UPDATE `material` SET `mrqty` = `mrqty` - ? WHERE `mid` = ?");
                $statement->bind_param("ii", $material["omqty"], $material["mid"]);
                $statement->execute();
            }
        }

        $statement = $database->prepare("DELETE FROM `orders` WHERE `oid` = ?");
        $statement->bind_param("i", $_POST["oid"]);
        $statement->execute();
    
        $statement->store_result();
        if ($statement->affected_rows == 0)
        {
            $database->rollback();
            http_response_code(500);
            render_error_page("Order Not Deleted", "The request failed due to unknown reasons.");
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
    header("Location: /admin/orders.php", true, 303);
    exit;
}

render_page("/admin/_orders/delete.tpl.php", "Delete Order", compact("order"), "warning");
