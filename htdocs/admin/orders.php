<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

ensure_logged_in();
ensure_staff();

if (!isset($_GET["action"])) { $_GET["action"] = "list"; }

switch ($_GET["action"])
{
    case "list":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/orders/list.php");
        break;
    case "edit":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/orders/edit.php");
        break;
    case "delete":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/orders/delete.php");
        break;
    default:
        header("Location: /admin/orders.php", true, 301);
        exit();
}
