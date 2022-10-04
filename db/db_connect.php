<?php

$hostName = "localhost";
$userName = "root";
$pass = "";
$db_name = "todo-list";

try {
    $conn = new PDO ("mysql:host=$hostName;dbname=$db_name",
$userName,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo 'Connection failed : '. $e->getMessage();
}