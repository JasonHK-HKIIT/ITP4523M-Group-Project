<?php

if (!isset($_GET["action"])) { $_GET["action"] = "list"; }

switch ($_GET["action"])
{
    case "list":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/materials/list.php");
        break;
    case "edit":
    case "new":
        break;
    case "delete":
        break;
    default:
        header("Location: /admin/materials.php", true, 301);
        exit();
        break;
}
