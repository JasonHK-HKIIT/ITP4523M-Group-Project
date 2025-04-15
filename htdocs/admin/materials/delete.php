<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$statement = $database->prepare("SELECT `mid`, `mname` FROM `material` WHERE `mid` = ?");
$statement->execute([$_GET["id"]]);
$result = $statement->get_result();
if ($result->num_rows == 0)
{
    http_response_code(404);
    render_error_page("Material Not Found", "The requested material does not exist.");
    exit;
}

$material = $result->fetch_assoc();
render_page("/admin/materials/delete.tpl.php", "Delete Material", compact("material"), "warning");
