<?php

if (!isset($_GET["action"])) { $_GET["action"] = "list"; }

switch ($_GET["action"])
{
    case "list":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/products/list.php");
        break;
    case "edit":
    case "new":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/products/edit.php");
        break;
    case "delete":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/products/delete.php");
        break;
    default:
        header("Location: /admin/products.php", true, 301);
        exit();
        break;
}
