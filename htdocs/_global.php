<?php

session_start();

define("USER_CLIENT", "0");
define("USER_STAFF", "1");

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

function is_logged_in(): bool
{
    return !empty($_SESSION["user_id"]);
}

function is_staff(): bool
{
    return (is_logged_in() && ($_SESSION["user_type"] === "1"));
}

function is_admin_page(): bool
{
    static $value;
    if (isset($value)) { return $value; }
    return ($value = str_starts_with($_SERVER["REQUEST_URI"], "/admin/"));
}

function render_page(string $template_path, string $title = "", array $vars = [], string $theme = "primary"): void
{
    $tpl = $_SERVER["DOCUMENT_ROOT"] . $template_path;
    $page_title = $title;

    $navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . (is_admin_page() ? "/admin/_navbar.tpl.php" : "/_navbar.tpl.php");
    $navbar_theme = $theme;

    unset($template_path, $title, $theme);
    extract($vars, EXTR_SKIP);
    require_once $_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php";
}

function render_error_page(string $title, string $message, string $page_title = "Error")
{
    render_page(
        "/_error.tpl.php", 
        $page_title, 
        ["error_title" => $title, "error_message" => $message], 
        "danger");
}
