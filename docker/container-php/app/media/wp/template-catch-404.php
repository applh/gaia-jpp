<?php

// return 200 OK
// http_response_code(200);
// echo date("Y-m-d H:i:s");

// get server name
// $server_name = $_SERVER["SERVER_NAME"];
// (no port)

// get host name
// $host_name = $_SERVER["HTTP_HOST"];
// (with port)

// echo xps_action::$template;

// CONNECT GAIA CMS ON WP 🔥⭐️😱
// So easy as gaia handles all requests dynamically 😎

// get the index.php file from gaia 
http_response_code(200);

// allow CORS
header("Access-Control-Allow-Origin: *");

$gaia_index = xp_studio::$plugin_dir . "/public/index.php";

// WARNING: when using GAIA as WP plugin, data dir is not the same
xpa_os::kv("path_data", dirname(xps_action::$local_dir));

include_once $gaia_index;


