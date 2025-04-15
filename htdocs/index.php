<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

ensure_client();
render_page("/index.tpl.php", "Client Portal");
