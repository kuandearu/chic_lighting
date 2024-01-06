<?php 
$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'chic_lighting';
$conn = new mysqli($server, $user, $pass,$dbname);
$conn->select_db($dbname);
?>