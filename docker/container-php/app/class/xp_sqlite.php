<?php

class xp_sqlite 
{

    static function db_create ($name)
    {
        // create a new sqlite database with $name
        $pdo = new PDO("sqlite:../my-data/$name.sqlite");

        // set error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create a table geocms (if not exists) with columns: id, title, content, cat, tags, created, updated, x, y, z, t
        $sql = "CREATE TABLE IF NOT EXISTS geocms (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT,
            content TEXT,
            cat TEXT,
            tags TEXT,
            created TEXT,
            updated TEXT,
            x REAL,
            y REAL,
            z REAL,
            t REAL
        )";
        // execute sql
        $pdo->exec($sql);
        
        // return the database
        return $pdo;
    }

    static function insert ($table, $data)
    {
        // insert data into table
        // $data is an array with keys and values
        // fill missing keys with null
        $data["title"] ??= null;
        $data["content"] ??= null;
        $data["cat"] ??= null;
        $data["tags"] ??= null;
        $data["created"] ??= null;
        $data["updated"] ??= null;
        $data["x"] ??= null;
        $data["y"] ??= null;
        $data["z"] ??= null;
        $data["t"] ??= null;

        extract($data);

        $prepared_sql = 
        <<<SQL
        INSERT INTO `$table` 
        (title, content, cat, tags, created, updated, x, y, z, t)
        VALUES
        (:title, :content, :cat, :tags, :created, :updated, :x, :y, :z, :t)
        SQL;

        // connect to database
        $pdo = xp_sqlite::db_create("gaia");
        // prepare sql
        $stmt = $pdo->prepare($prepared_sql);
        // execute sql
        // https://www.php.net/manual/fr/pdostatement.execute.php
        $stmt->execute($data);
    }
}