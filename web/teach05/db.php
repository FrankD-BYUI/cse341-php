<?php

function connectDB() {
    try
    {
      $dbUrl = getenv('DATABASE_URL');
    
      $dbOpts = parse_url($dbUrl);
    
      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');
    
      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if(is_object($db)) {
          return $db;
      }
    }
    catch (PDOException $ex)
    {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }





//   $dbUrl = getenv('DATABASE_URL');

//   $dbopts = parse_url($dbUrl);

//   $dbHost = $dbopts["host"];
//   $dbPort = $dbopts["port"];
//   $dbUser = $dbopts["user"];
//   $dbPassword = $dbopts["pass"];
//   $dbName = ltrim($dbopts["path"],'/');

//   $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName";
//   $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
//   // Create the actual connection object and assign it to a variable
//   try {
//       $link = new PDO($dsn, $dbUser, $dbPassword, $options);
//       if(is_object($link)) {
//           return $link;
//       }
//   } catch(PDOException $e) {
//       var_dump($e);
//       exit;
//   }
}



?>