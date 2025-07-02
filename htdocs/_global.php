<?php

session_start();

const USER_CLIENT = "0";
const USER_STAFF = "1";

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

function is_logged_in(): bool
{
    return !empty($_SESSION["user_id"]);
}

function is_staff(): bool
{
    return (is_logged_in() && ($_SESSION["user_type"] == USER_STAFF));
}

function is_client(): bool
{
    return (!is_logged_in() || ($_SESSION["user_type"] == USER_CLIENT));
}

function is_admin_page(): bool
{
    static $value;
    if (isset($value)) { return $value; }
    return ($value = str_starts_with($_SERVER["REQUEST_URI"], "/admin/"));
}

function ensure_logged_out(): void
{
    if (is_logged_in())
    {
        header(sprintf("Location: %s", is_staff() ? "/admin" : "/"), true, 307);
        exit;
    }
}

function ensure_logged_in(): void
{
    if (!is_logged_in())
    {
        header(sprintf("Location: /login.php?%s", http_build_query(["return" => substr($_SERVER['REQUEST_URI'], 1)])), true, 307);
        exit;
    }
}

function ensure_client(): void
{
    if (!is_client())
    {
        header("Location: /admin", true, 307);
        exit;
    }
}

function ensure_staff(): void
{
    if (!is_staff())
    {
        http_response_code(403);
        render_error_page("Access Denied", "You don’t have permission to view this page.");
    }
}

/**
 * Check if a given string is valid telephone number.
 * 
 * @param string $telephone A string to be checked
 * @return bool|int
 */
function is_telephone(string $telephone): bool|int
{
    return preg_match("/^[2-9]\\d{7}\$/", $telephone);
}

/**
 * Check if a given file is JPEG image.
 * 
 * @param string $file A file to be checked
 * @return bool
 */
function is_jpeg(string $file): bool
{
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    return ($finfo->file($file) == "image/jpeg");
}

function is_balanced(array $array, array ...$arrays): bool
{
    $count = count($array);
    foreach ($arrays as $a)
    {
        if (count($a) != $count) { return false; }
    }

    return true;
}

function render_date(string $time_string): string
{
    return date("Y-m-d", strtotime($time_string));
}

const ORDER_STATUS_REJECTED = 0;
const ORDER_STATUS_OPEN = 1;
const ORDER_STATUS_ACCEPTED = 2;
const ORDER_STATUS_PROCESSING = 3;
const ORDER_STATUS_PENDING_DELIVERY = 4;
const ORDER_STATUS_COMPLETED = 5;

function render_order_status(int $status): string
{
    return match ($status)
    {
        ORDER_STATUS_REJECTED => "Rejected",
        ORDER_STATUS_OPEN => "Open",
        ORDER_STATUS_ACCEPTED => "Accepted",
        ORDER_STATUS_PROCESSING => "Processing",
        ORDER_STATUS_PENDING_DELIVERY => "Pending Delivery",
        ORDER_STATUS_COMPLETED => "Completed",
    };
}

/**
 * Render the web page with a given template.
 * 
 * @param string $template_path The path to the template
 * @param string $title         The title of the page
 * @param array  $vars          Variables to be substituted
 * @param string $theme         The theme for the page
 * @return void
 */
function render_page(string $template_path, string $title = "", array $vars = [], string $theme = "primary"): void
{
    $tpl = $_SERVER["DOCUMENT_ROOT"] . $template_path;
    $page_title = $title;
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
