<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$IS_ADMIN_PAGE = str_starts_with($_SERVER["REQUEST_URI"], "/admin/");

function render_page(string $template_path, string $title = "", array $vars = []): void
{
    global $IS_ADMIN_PAGE;

    $tpl = $_SERVER["DOCUMENT_ROOT"] . $template_path;
    $navbar_menu_tpl = $_SERVER["DOCUMENT_ROOT"] . ($IS_ADMIN_PAGE ? "/admin/_navbar.tpl.php" : "/_navbar.tpl.php");
    $page_title = $title;

    extract($vars, EXTR_SKIP);
    require_once $_SERVER["DOCUMENT_ROOT"] . "/_base.tpl.php";
}
