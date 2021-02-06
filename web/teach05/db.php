<?php

function connectDB() {
    $dbUrl = getenv('DATABASE_URL');

    $dbopts = parse_url($dbUrl);
    var_dump($dbopts);

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName";
    //$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $dbUser, $dbPassword);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $link;
    } catch(PDOException $e) {
        var_dump($e);
        echo "it failed!";
        exit;
    }
}
