<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$IS_ADMIN_PAGE = str_starts_with($_SERVER["REQUEST_URI"], "/admin/");

function render_page(string $template_path, string $title = "", array $vars = [], string $theme = "primary"): void
{
    global $IS_ADMIN_PAGE;

    $tpl = $_SERVER["DOCUMENT_ROOT"] . $template_path;
    $page_title = $title;

    $navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . ($IS_ADMIN_PAGE ? "/admin/_navbar.tpl.php" : "/_navbar.tpl.php");
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
