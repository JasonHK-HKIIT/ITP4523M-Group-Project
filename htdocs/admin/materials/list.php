<?php
if (!isset($ENTRYPOINT))
{
    http_response_code(403);
    exit();
}

require_once("list.html");
