<?php

/*
            - MYSQL_ROOT_PASSWORD=mydbroot
            - MYSQL_DATABASE=mydb
            - MYSQL_USER=mydbuser
            - MYSQL_PASSWORD=mydbpassword

*/
try {
    // use PDO to connect to the database myqsl:mydb, user=mydbuser, password=mydbpassword
    $pdo = new PDO('mysql:dbname=mydb;host=mydbhost', 'mydbuser', 'mydbpassword');

    // prepare a query
    // show all tables in the database
    $stmt = $pdo->prepare('SHOW TABLES');

    // execute the query
    $stmt->execute();

    // fetch all results
    $result = $stmt->fetchAll();

    // print the results
    print_r($result);

    // find all rows in the table 'geocms'
    $stmt = $pdo->prepare('SELECT * FROM geocms');
    $stmt->execute();
    $result = $stmt->fetchAll();
    print_r($result);

}
catch (PDOException $e) {
    echo $e->getMessage();
}