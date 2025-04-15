<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

ensure_logged_in();
ensure_staff();

render_page("/admin/index.tpl.php", "Staff Portal");
