<?php

function connectDB() {
  $dbUrl = getenv('DATABASE_URL');

  if (empty($dbUrl)) {
      // example localhost configuration URL with postgres username and a database called cs313db
      $dbUrl = "postgres://ocwvfhnmjqterq:23fc9e370bfe6d6177eb4c590eced993389439707b5b2a4c0573295d94423a6d@ec2-54-86-189-179.compute-1.amazonaws.com:5432/d92792seehr1o1";
  }

  $dbopts = parse_url($dbUrl);

  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  $dbName = ltrim($dbopts["path"],'/');

  $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  // Create the actual connection object and assign it to a variable
  try {
      $link = new PDO($dsn, $dbUser, $dbPassword, $options);
      if(is_object($link)) {
          return $link;
      }
  } catch(PDOException $e) {
      var_dump($e);
      exit;
  }
}



?>