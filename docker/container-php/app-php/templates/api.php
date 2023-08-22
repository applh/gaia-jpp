<?php

$data = [];

$now = date("Y-m-d H:i:s");
$data["now"] = $now;
$data["request"] = $_REQUEST;
$data["files"] = $_FILES;

response::$content_type = "application/json";
response::$content = json_encode($data, JSON_PRETTY_PRINT);
