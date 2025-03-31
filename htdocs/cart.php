<?php

if (!isset($_GET["action"])) { $_GET["action"] = "view"; }

switch ($_GET["action"])
{
    case "view":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/cart/view.php");
        break;
    case "edit":
        require_once($_SERVER["DOCUMENT_ROOT"] . "/cart/edit.php");
        break;
    default:
        header("Location: /cart.php", true, 301);
        exit();
}
