<?php

class model
{
    static function connect ()
    {
        static $pdo = null;

        if ($pdo !== null)
            return $pdo;

        // popular default values on localhost / MacOS
        $db_user = "root";
        $db_password = "root";

        // get env APP_MODE
        $app_mode = getenv("APP_MODE");
        if ($app_mode == "docker") {
            // get env MYSQL_HOST, MYSQL_DATABASE, MYSQL_USER, MYSQL_PASSWORD
            $db_host = getenv("MYSQL_HOST");
            $db_name = getenv("MYSQL_DATABASE");
            $db_user = getenv("MYSQL_USER");
            $db_password = getenv("MYSQL_PASSWORD");
        }
        else {
            // TODO: cleanup this code

            $env = "docker";

            // check if launch in CLI mode
            if (php_sapi_name() == "cli") {
                $env = "localhost";
            }
            // if port is 8777, then it's localhost
            if ($_SERVER["SERVER_PORT"] == 8777) {
                $env = "localhost";
            }
            // if port is 80, then it's mydbhost
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
            $db_host = $db_hosts[$env];

        }

        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
        $pdo ??= new PDO($dsn, $db_user, $db_password);

        return $pdo;
    }

    static function read($table = null)
    {
        $table ??= "users";
        $order_by = "id DESC";

        $limit = intval($_REQUEST["limit"] ?? 100);
        $offset = intval($_REQUEST["offset"] ?? 0);
        // limit and offset must be positive
        $limit = max(0, $limit);
        $offset = max(0, $offset);

        $sql = "SELECT * FROM `$table` ORDER BY $order_by LIMIT $limit OFFSET $offset";
        model::send_sql($sql);
    }

    static function send_sql ($sql)
    {
        $pdo = model::connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        response::$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
