<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$error_messages = [];

$min_quantity = 1;
$max_quantity = PHP_INT_MAX;

$oid = $_POST["oid"] ?? $_GET["id"];
$statement = $database->prepare("SELECT `oid`, `odate`, `cname`, `ctel`, `caddr`, `orders`.`pid`, `pname`, `pcost`, `oqty`, `ocost`, `ostatus`, `odeliverdate` FROM `orders` LEFT JOIN `product` ON `orders`.`pid` = `product`.`pid` LEFT JOIN `customer` ON `orders`.`cid` = `customer`.`cid` WHERE `oid` = ? LIMIT 1");
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

$statement = $database->prepare("SELECT `prodmat`.`mid`, `mname`, `munit`, `mqty`, `mrqty`, `mreorderqty`, `pmqty`, `oqty` * `pmqty` AS `omqty` FROM `orders` CROSS JOIN `prodmat` ON `orders`.`pid` = `prodmat`.`pid` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid` WHERE `oid` = ?");
$statement->bind_param("i", $oid);
$statement->execute();

$result = $statement->get_result();
$materials = $result->fetch_all(MYSQLI_ASSOC);

if ($order["ostatus"] >= ORDER_STATUS_ACCEPTED)
{
    $min_quantity = $max_quantity = $order["oqty"];
}
else
{
    foreach ($materials as $material)
    {
        $max_quantity = min($max_quantity, floor(($material["mqty"] - $material["mrqty"]) / $material["pmqty"]));     
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if (is_order_status($order["ostatus"], $_POST["ostatus"])
        && (ctype_digit(@$_POST["oqty"]) && (($_POST["oqty"] >= $min_quantity) && ($_POST["oqty"] <= $max_quantity)))
        && (empty($_POST["odeliverdate"]) || is_datetime($_POST["odeliverdate"])))
    {
        $database->begin_transaction();
        try
        {
            $ocost = $order["pcost"] * $_POST["oqty"];
            $odeliverdate = !empty($_POST["odeliverdate"]) ? date("Y-m-d H:i:s", datetime_to_timestamp($_POST["odeliverdate"])) : null;
            $statement = $database->prepare("UPDATE `orders` SET `ostatus` = ?, `oqty` = ?, `ocost` = ?, `odeliverdate` = ? WHERE `oid` = ?");
            $statement->bind_param("iiisi", $_POST["ostatus"], $_POST["oqty"], $ocost, $odeliverdate, $_POST["oid"]);
            $statement->execute();

            for ($status = $order["ostatus"] + 1; $status <= $_POST["ostatus"]; $status++)
            {
                switch ($status)
                {
                    case ORDER_STATUS_REJECTED:
                        break;
                    case ORDER_STATUS_OPEN:
                        break;
                    case ORDER_STATUS_ACCEPTED:
                    {
                        foreach ($materials as $material)
                        {
                            $omqty = $material["pmqty"] * $_POST["oqty"];
                            $statement = $database->prepare("UPDATE `material` SET `mrqty` = `mrqty` + ? WHERE `mid` = ?");
                            $statement->bind_param("ii", $omqty, $material["mid"]);
                            $statement->execute();
                        }

                        break;
                    }
                    case ORDER_STATUS_PROCESSING:
                    {
                        foreach ($materials as $material)
                        {
                            $omqty = $material["pmqty"] * $_POST["oqty"];
                            $statement = $database->prepare("UPDATE `material` SET `mqty` = `mqty` - ?, `mrqty` = `mrqty` - ? WHERE `mid` = ?");
                            $statement->bind_param("iii", $omqty, $omqty, $material["mid"]);
                            $statement->execute();
                        }

                        break;
                    }
                    case ORDER_STATUS_PENDING_DELIVERY:
                        break;
                    case ORDER_STATUS_COMPLETED:
                        break;
                }
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
    else
    {
        http_response_code(400);
        
        $order["odeliverdate"] = $_POST["odeliverdate"];

        if (!is_order_status($order["ostatus"], $_POST["ostatus"]))
        {
            $error_messages["ostatus"] = "Invalid order status";
        }
        else
        {
            $order["ostatus"] = $_POST["ostatus"];
        }
        
        if (($order["ostatus"] >= ORDER_STATUS_ACCEPTED))
        {
            if ($_POST["oqty"] != $order["oqty"])
            {
                $error_messages["oqty"] = "This field is readonly";
            }
        }
        else
        {
            $order["oqty"] = $_POST["oqty"];

            if (empty($_POST["oqty"]) && ($_POST["oqty"] != 0))
            {
                $error_messages["oqty"] = "This field is required";
            }
            else if (!ctype_digit($_POST["oqty"]))
            {
                $error_messages["oqty"] = "This field must be a number";
            }
            else if (($_POST["oqty"] < $min_quantity) || ($_POST["oqty"] > $max_quantity))
            {
                $error_messages["oqty"] = sprintf("This field must be between %d and %d", $min_quantity, $max_quantity);
            }
        }

        if (!empty($_POST["odeliverdate"]) && !is_datetime($_POST["odeliverdate"]))
        {
            $error_messages["odeliverdate"] = "This field must be a datetime";
        }
    }
}

render_page("/admin/_orders/edit.tpl.php", "Update Order", compact("order", "materials", "min_quantity", "max_quantity", "error_messages"),
    extra_head: ['<script src="/assets/admin/orders.edit.js" defer async></script>']);
