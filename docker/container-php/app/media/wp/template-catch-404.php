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
$gaia_index = xp_studio::$plugin_dir . "/public/index.php";
include_once $gaia_index;


