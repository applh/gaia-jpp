<?php

header('Content-Type: application/json');

$env = "docker";
$server_port = $_SERVER["SERVER_PORT"] ?? null;

$db_user = "root";
$db_password = "root";

// var_dump($server_port);

// check if launch in CLI mode
if (php_sapi_name() == "cli") {
    $env = "localhost";
}
// if port is 8777, then it's localhost
if ($_SERVER["SERVER_PORT"] == 8777) {
    $env = "localhost";
}
if ($_SERVER["SERVER_PORT"] == 80) {
    $env = "mydbhost";
    $db_user = "root";
    $db_password = "mydbroot";
}

$db_hosts = [
    "mydbhost" => "mydbhost",
    "localhost" => "localhost",
    "docker" => "host.docker.internal",
];

// var_dump($env);

$db_host = $db_hosts[$env];

$limit = intval($_REQUEST["limit"] ?? 1000);

$sql_setup = __DIR__ . "/../my-data/users.sql";
$sql_setup = realpath($sql_setup);
if ($sql_setup !== false) {
    // connect to SQL server with PDO user/password are root/root
    // var_dump($dsn);
    // $dsn = "mysql:host=$db_host";
    // $pdo ??= new PDO($dsn, $db_user, $db_password);
    // $sql_setup = file_get_contents($sql_setup);
    // $pdo->exec($sql_setup);
}

$dsn = "mysql:host=$db_host;dbname=app-php";
$pdo ??= new PDO($dsn, $db_user, $db_password);

$limit = intval($_REQUEST["limit"] ?? 1000);
// get rows from table users
$stmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC LIMIT $limit");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// show rows as json data
echo json_encode($rows ?? []);

