<?php

$result = $database->query("SELECT * FROM `material`");
$materials = $result->fetch_all(MYSQLI_ASSOC);

render_page("/admin/_materials/list.tpl.php", "Materials", compact("materials"));
