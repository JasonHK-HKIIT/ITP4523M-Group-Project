<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$mid = $_POST["mid"] ?? $_GET["id"];
$statement = $database->prepare("SELECT `mid`, `mname` FROM `material` WHERE `mid` = ? LIMIT 1");
$statement->bind_param("i", $mid);
$statement->execute();

$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);
    render_error_page("Material Not Found", "The requested material does not exist.");
    exit;
}
$material = $result->fetch_assoc();

$statement = $database->prepare("SELECT `pid` FROM `prodmat` WHERE `mid` = ?");
$statement->bind_param("i", $mid);
$statement->execute();

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

    try
    {
        $statement = $database->prepare("DELETE FROM `material` WHERE `mid` = ?");
        $statement->bind_param("i", $_POST["mid"]);
        $statement->execute();
    
        $statement->store_result();
        if ($statement->affected_rows == 0)
        {
            http_response_code(500);
            render_error_page("Material Not Deleted", "The request failed due to unknown reason.");
            exit;
        }
    }
    catch (mysqli_sql_exception $ex)
    {
        http_response_code(500);
        render_error_page(sprintf("MySQL Error %d", $ex->getCode()), $ex->getMessage());
        exit;
    }

    header("Location: /admin/materials.php", true, 308);
    exit;
}

render_page("/admin/_materials/delete.tpl.php", "Delete Material", compact("material"), "warning");
