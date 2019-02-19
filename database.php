<?php
$server = 'localhost';
$username = 'devbloom_cms';
$password = 'cms2018!!';
$database = 'devbloom_cms';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
