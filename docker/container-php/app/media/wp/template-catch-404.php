<?php
// return 200 OK
http_response_code(200);
echo date("Y-m-d H:i:s");
// get server name
$server_name = $_SERVER["SERVER_NAME"];
echo " $server_name";
// get host name
$host_name = $_SERVER["HTTP_HOST"];
echo " $host_name";

echo xps_action::$template;



