<?php
// Entrypoint: /logout.php
//
// Handle user logout. Session will be cleared when the user logged out.

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

$_SESSION = [];
header("Location: /", true, 303);
