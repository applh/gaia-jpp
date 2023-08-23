<?php

// warning: create local variables from array keys
extract($params);

$time_start = microtime(true);

model::read();

$time_end = microtime(true);
$time_ms = 1000 * ($time_end - $time_start);
// keep only 3 decimals
$time_ms = intval($time_ms * 1000) / 1000;

$limit = intval($_REQUEST["limit"] ?? 100);

// show rows as json data
response::$content_type = "application/json";
response::$content = json_encode([
    "limit" => $limit,
    "time_ms" => $time_ms,
    "total" => count(response::$rows ?? []),
    "data" => response::$rows ?? []
]);
