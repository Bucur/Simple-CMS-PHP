<?php
$server = 'localhost';
$username = 'username';
$password = 'password';
$database = 'databasename';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
