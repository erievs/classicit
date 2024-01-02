<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = 'tBFO6DH@';
$db = 'classicit';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

?>
