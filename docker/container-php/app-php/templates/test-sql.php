<?php

// warning: create local variables from array keys
extract($params);

$time_start = microtime(true);

$limit = intval($_REQUEST["limit"] ?? 100);
$offset = intval($_REQUEST["offset"] ?? 0);

// loop and launch read as long as count of data is not limit
$rows = [];
$total = 0;
$count_request = 0;
$founds = [];
while (count($rows) < $limit) {
    $current_limit = mt_rand(
        min(0.05 * $limit, $limit - count($rows)),
        min(0.1 * $limit, $limit - count($rows)),
                    );
    $current_offset = $offset + count($rows);
    model::read("users", $current_limit, $current_offset);
    $founds[] = response::$rows ?? [];
    $rows = array_merge($rows, response::$rows);
    $total = count($rows);
    $count_request++;
}

// model::read("users", $limit, $offset);
// $rows1 = response::$rows ?? [];

// model::read("users", $limit, $offset);
// $rows2 = response::$rows ?? [];

$time_end = microtime(true);
$time_ms = 1000 * ($time_end - $time_start);
// keep only 3 decimals
$time_ms = intval($time_ms * 1000) / 1000;

// show rows as json data
response::$content_type = "application/json";
response::$content = json_encode([
    "limit" => $limit,
    "time_ms" => $time_ms,
    "total" => $total,
    "count_request" => $count_request,
    "data" => $founds,
]);
