<?php

/*
-- DROP TABLE IF EXISTS `geocms`;

CREATE TABLE IF NOT EXISTS `geocms` 
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    path TEXT,
    filename TEXT,
    code TEXT,
    url TEXT,
    title TEXT,
    content TEXT,
    media TEXT,
    cat TEXT,
    tags TEXT,
    created DATETIME,
    updated DATETIME,
    hash TEXT,
    x REAL,
    y REAL,
    z REAL,
    t REAL
);
 
 */
// read sql code from file my-data/table-create-geocms.sql
// and execute it
$sql = file_get_contents(__DIR__ . "/../my-data/table-create-geocms.sql");
echo $sql;

// model::send_sql($sql);

// model::read("geocms");
// print_r(response::$rows);

// insert 100 rows in table geocms
for ($i = 0; $i < 100; $i++) {
    $sql = "INSERT INTO geocms (title, content) VALUES ('title $i', 'content $i')";
    // model::send_sql($sql);
}

// get env APP_MODE
$env = getenv("APP_MODE");
var_dump($env);