<?php

class xp_sqlite
{
    static $logs = [];

    static function db_create($name)
    {
        $db_path = dirname(__DIR__) . "/my-data/$name.sqlite";
        if (file_exists($db_path)) {
            // echo "database $name ($db_path) already exists\n";
            // return the database
            $pdo = new PDO("sqlite:$db_path");
        } else {
            // create a new sqlite database with $name
            $pdo = new PDO("sqlite:$db_path");

            // set error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // get all files in ../media/table-*.sql
            $sql_files = glob(dirname(__DIR__) . "/media/table-*.sql");
            // loop on files
            foreach ($sql_files as $sql_file) {
                // get sql from file
                $sql = file_get_contents($sql_file);
                // execute sql
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
            }
        }

        // return the database
        return $pdo;
    }

    static function send_sql($sql, $tokens = [])
    {
        // connect to database
        $pdo = xp_sqlite::db_create("gaia");
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
        // xp_router::$json["send_sql"] = $txt;

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
        $stmt = xp_sqlite::send_sql($sql, $tokens);
        return $stmt;
    }

    // read
    static function read1($table, $id)
    {
        // read row with id $id from table $table
        $sql = "SELECT * FROM `$table` WHERE id = :id";
        $tokens = ["id" => $id];
        $stmt = xp_sqlite::send_sql($sql, $tokens);
        return $stmt?->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    static function read ($table, $extra_sql)
    {
        $sql = "SELECT * FROM `$table` $extra_sql";
        $stmt = xp_sqlite::send_sql($sql);

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

        $stmt = xp_sqlite::send_sql($sql, $tokens);
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
        $stmt = xp_sqlite::send_sql($sql, $tokens);
        return $stmt;
    }
}
