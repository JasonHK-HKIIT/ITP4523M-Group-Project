<?php

$result = $database->query("SELECT `pid`, `pname`, `pdesc` FROM `product`");
$products = $result->fetch_all(MYSQLI_ASSOC);

render_page("/admin/_products/list.tpl.php", "Products", compact("products"));
