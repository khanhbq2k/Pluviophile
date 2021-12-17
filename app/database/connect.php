<?php

//PHPMyAdmin credentials, replace with your own credentials
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'pluviophile';

$conn = new mysqli($host, $user, $pass, $db_name);

if($conn->connect_error){
    die('Database connection error: ' . $conn->connect_error);
}