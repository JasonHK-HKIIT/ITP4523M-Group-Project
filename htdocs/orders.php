<?php

if (!isset($_GET["action"])) { $_GET["action"] = "list"; }

switch ($_GET["action"])
{
    case "list":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/orders/list.php");
        break;
    case "view":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/orders/view.php");
        break;
    case "delete":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/orders/delete.php");
        break;
    case "new":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/orders/new.php");
        break;
    default:
        header("Location: /orders.php", true, 301);
        exit();
}
