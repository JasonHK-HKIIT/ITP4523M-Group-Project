<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

ensure_logged_in();
ensure_staff();

if (!isset($_GET["action"])) { $_GET["action"] = "list"; }

switch ($_GET["action"])
{
    case "list":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/_materials/list.php");
        break;
    case "edit":
    case "new":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/_materials/edit.php");
        break;
    case "delete":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/_materials/delete.php");
        break;
    default:
        header("Location: /admin/materials.php", true, 301);
        exit();
}
