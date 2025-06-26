<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

ensure_client();
ensure_logged_in();

if (!isset($_GET["action"])) { $_GET["action"] = "list"; }

switch ($_GET["action"])
{
    case "list":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/_orders/list.php");
        break;
    case "view":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/_orders/view.php");
        break;
    case "delete":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/_orders/delete.php");
        break;
    case "new":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/_orders/new.php");
        break;
    default:
        header("Location: /orders.php", true, 301);
        exit();
}
