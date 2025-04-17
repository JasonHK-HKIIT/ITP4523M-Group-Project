<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_database.php";

$material = [];

$action = $_GET["action"];
if ($action === "edit")
{
    $statement = $database->prepare("SELECT `mid`, `mname`, `mqty`, `mrqty`, `munit`, `mreorderqty` FROM `material` WHERE `mid` = ?");
    $statement->execute([$_GET["id"]]);
    $result = $statement->get_result();
    $material = $result->fetch_assoc();
}

render_page("/admin/_materials/edit.tpl.php",(($action === "edit") ? "Edit" : "New") . " Material", compact("action", "material"));
