<?php

$env = "docker";
// check if launch in CLI mode
if (php_sapi_name() == "cli") {
    $env = "localhost";
}
// if port is 8777, then it's localhost
if ($_SERVER["SERVER_PORT"] == 8777) {
    $env = "localhost";
}

$db_hosts = [
    "localhost" => "localhost",
    "docker" => "host.docker.internal",
];

$db_host = $db_hosts[$env];
// connect to SQL server with PDO user/password are root/root
$dsn = "mysql:host=$db_host;dbname=app-php";
$pdo = new PDO($dsn, 'root', 'root');

$limit = intval($_REQUEST["limit"] ?? 1000);
// get rows from table users
$stmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC LIMIT $limit");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// show rows as json data
header('Content-Type: application/json');
echo json_encode($rows);

