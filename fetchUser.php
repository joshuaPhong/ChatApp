<?php
// databaseConnection.php
$dsn = "mysql:host=localhost; dbname:chat";
$user = "root";
$password = "root";
$connect = new PDO($dsn, $user, $password);
