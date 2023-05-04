<?php

class xpa_sqlite
{
    static $logs = [];
    // keep pdo connections in a static array
    static $pdos = [];
    static $db_name = "gaia";

    static function db_create($name)
    {
        // if pdo exists in static array, return it
        if (isset(static::$pdos[$name])) {
            return static::$pdos[$name];
        }

        $pdo = null;
        try {
            // else create it
            $path_data = cli::kv("path_data");
            $db_path = "$path_data/$name.sqlite";
            $has_db_file = file_exists($db_path);
            $pdo = new PDO("sqlite:$db_path");
            // set error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (!$has_db_file) {
                static::db_init($pdo);
            }
            // add pdo to static array
            static::$pdos[$name] = $pdo;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }

        // return the database
        return $pdo;
    }

    static function db_init ($pdo)
    {
        // get all files in ../media/table-*.sql
        $path_media = cli::kv("root") . "/media";
        $sql_files = glob("$path_media/table-*.sql");
        // loop on files
        foreach ($sql_files as $sql_file) {
            // get sql from file
            $sql = file_get_contents($sql_file);
            // execute sql
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }

    }

    static function send_sql($sql, $tokens = [], $db_name = null)
    {
        // connect to database
        $pdo = xpa_sqlite::db_create($db_name ?? static::$db_name);
        // prepare sql
        $stmt = $pdo->prepare($sql);
        // execute sql
        // https://www.php.net/manual/fr/pdostatement.execute.php
        $stmt->execute($tokens);

        // debug
        ob_start();
        $stmt->debugDumpParams();
        $txt = ob_get_clean();
        static::$logs[] = $txt;
        // xpa::$json["send_sql"] = $txt;

        // return result
        return $stmt;
    }

    // CRUD functions

    // delete
    static function delete($table, $id)
    {
        // delete row with id $id from table $table
        $sql = "DELETE FROM `$table` WHERE id = :id";
        $tokens = ["id" => $id];
        $stmt = static::send_sql($sql, $tokens);
        return $stmt;
    }

    // read
    static function read1($table, $id)
    {
        // read row with id $id from table $table
        $sql = "SELECT * FROM `$table` WHERE id = :id";
        $tokens = ["id" => $id];
        $stmt = static::send_sql($sql, $tokens);
        return $stmt?->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    static function read ($table, $extra_sql)
    {
        $sql = "SELECT * FROM `$table` $extra_sql";
        $stmt = static::send_sql($sql);

        return $stmt?->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    // create
    static function create($table, $data)
    {
        // create a new row in table $table with data $data
        // $data is an array with keys and values
        $cols = "";
        $vals = "";
        $tokens = [];

        foreach ($data as $col => $val) {
            $cols .= "`$col`, ";
            $vals .= ":$col, ";
            $tokens[$col] = $val;
        }
        $cols = substr($cols, 0, -2);
        $vals = substr($vals, 0, -2);
        $sql =
            <<<SQL
        INSERT INTO `$table`
        ( $cols )
        VALUES
        ( $vals )
        SQL;

        $stmt = static::send_sql($sql, $tokens);
        return $stmt;
    }

    // update
    static function update($table, $id, $data)
    {
        // update row with id $id in table $table with data $data
        // $data is an array with keys and values
        $sql = "UPDATE `$table` SET ";
        $tokens = [];
        foreach ($data as $col => $val) {
            $sql .= "`$col` = :$col, ";
            $tokens[$col] = $val;
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE id = :id";
        $tokens["id"] = $id;
        $stmt = static::send_sql($sql, $tokens);
        return $stmt;
    }
}