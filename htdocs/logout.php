<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

$_SESSION = [];
header("Location: /", true, 307);
