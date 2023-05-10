<?php

// Database configuration
define("HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","");
define("DB_NAME","blog_system");

try
{
    $dsn = "mysql:host =".HOST.";dbname=".DB_NAME;
    $pdo = new pdo ($dsn ,DB_USERNAME,DB_PASSWORD);
}
catch(PDOException $e)
{
  echo  "ERROR";  
}







?>