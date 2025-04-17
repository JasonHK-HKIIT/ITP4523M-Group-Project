<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$statement = $database->prepare("SELECT `mid`, `mname` FROM `material` WHERE `mid` = ?");
$statement->execute([$_POST["mid"] ?? $_GET["id"]]);
$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);
    render_error_page("Material Not Found", "The requested material does not exist.");
    exit;
}
$material = $result->fetch_assoc();

$statement = $database->prepare("SELECT `pid` FROM `prodmat` WHERE `mid` = ?");
$statement->execute([$_GET["id"]]);
$result = $statement->get_result();
if ($result->num_rows > 0)
{
    http_response_code(400);
    render_error_page("Material In Use", sprintf("Delete the %d product(s) using this material first before continue.", $result->num_rows));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if (empty($_POST["mid"]))
    {
        http_response_code(400);
        render_error_page("Invalid Request", "The request received was invalid.");
        exit;
    }

    $statement = $database->prepare("DELETE FROM `material` WHERE `mid` = ?");
    try
    {
    $statement->execute([$_POST["mid"]]);
    }
    catch (mysqli_sql_exception $ex)
    {
        http_response_code(500);
        render_error_page("Execution Falied", "Failed to execute the request.");
        exit;
    }
    
    $statement->store_result();
    if ($statement->affected_rows == 0)
    {
        http_response_code(500);
        render_error_page("Material Not Deleted", "The request failed due to unknown reason.");
        exit;
    }

    header("Location: /admin/materials.php", true, 308);
    exit;
}

render_page("/admin/_materials/delete.tpl.php", "Delete Material", compact("material"), "warning");
