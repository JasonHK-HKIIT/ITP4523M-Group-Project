<?php

$DB_HOSTNAME = isset($_ENV["IS_DOCKER"]) ? "database" : "127.0.0.1";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_DATABASE = "ProjectDB";

$database = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

unset($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
