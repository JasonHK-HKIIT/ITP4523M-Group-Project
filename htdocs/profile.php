<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

ensure_client();
ensure_logged_in();

$statement = $database->prepare("SELECT `cid`, `cname`, `ctel`, `caddr`, `company` FROM `customer` WHERE `cid` = ?");
$statement->bind_param("i", $_SESSION["user_id"]);
$statement->execute();

$result = $statement->get_result();
$client = $result->fetch_assoc();

render_page("/profile.tpl.php", "Profile", compact("client"));
