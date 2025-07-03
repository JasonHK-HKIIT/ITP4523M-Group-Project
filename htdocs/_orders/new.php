<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$error_messages = [];
$max_quantity = PHP_INT_MAX;

$pid = $_POST["pid"] ?? $_GET["pid"];
$statement = $database->prepare("SELECT *, MIN(`pqty`) AS `pqty` FROM (SELECT `product`.`pid`, `pname`, `pcost`, FLOOR((`mqty` - `mrqty`) / `pmqty`) AS `pqty` FROM `product` CROSS JOIN `prodmat` ON `product`.`pid` = `prodmat`.`pid` LEFT JOIN `material` ON `prodmat`.`mid` = `material`.`mid`) `p` WHERE `pid` = ? GROUP BY `pid`");
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
if ($product["pqty"] == 0)
{
    http_response_code(400);
    render_error_page("Product Out of Stock", "The requested product is currently out of stock.");
    exit;
}

$statement = $database->prepare("SELECT `caddr` FROM `customer` WHERE `cid` = ?");
$statement->bind_param("i", $_SESSION["user_id"]);
$statement->execute();

$result = $statement->get_result();
$client = $result->fetch_assoc();

$order = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if (ctype_digit(@$_POST["oqty"]) && (($_POST["oqty"] > 0) && ($_POST["oqty"] <= $product["pqty"])))
    {
        $odate = date("Y-m-d H:i:s");
        $ocost = $product["pcost"] * $_POST["oqty"];
        $ostatus = ORDER_STATUS_OPEN;
        $statement = $database->prepare("INSERT INTO `orders` (`odate`, `cid`, `pid`, `oqty`, `ocost`, `ostatus`) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->bind_param("siiidi", $odate, $_SESSION["user_id"], $product["pid"], $_POST["oqty"], $ocost, $ostatus);
        $statement->execute();

        $result = $statement->store_result();
        if ($statement->affected_rows == 0)
        {
            http_response_code(500);
            render_error_page("Internal Server Error", "The request failed due to unknown reason.");
            exit;
        }

        header("Location: /orders.php", true, 307);
        exit;
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
        else if (($_POST["oqty"] < 1) || ($_POST["oqty"] > $product["pqty"]))
        {
            $error_messages["oqty"] = sprintf("This field must be between 1 and %d", $product["pqty"]);
        }
    }
}

render_page("/_orders/new.tpl.php", "New Order", compact("order", "product", "client", "error_messages"),
    extra_head: ['<script src="/assets/orders.new.js" defer async></script>']);
