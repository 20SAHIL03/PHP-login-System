<?php
$host = 'localhost:3307';
$dbname = 'accounts';
$user = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$dbname;port=3307";

$conn = new PDO($dsn, $user, $password);
