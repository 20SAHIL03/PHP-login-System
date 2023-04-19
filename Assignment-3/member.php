<?php
// Start the session
session_start();

// Check if the user is not logged in, if not, redirect to login page


if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}


// Database connection
try {
    $pdo = new PDO("mysql:host=localhost:3307;dbname=accounts;charset=utf8", "root", "");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Member Page</title>
</head>
<body>
    <?php require 'config/header.php' ?>
    <!-- <h1>Welcome, <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h1> -->
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <p>This is the member page of my website.</p>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta perspiciatis in unde iusto, error consequuntur maiores culpa ullam eveniet fugit?.</p>
    <p><button><a style="text-decoration: none;" href="logout.php">Logout</a></button></p>
    
    <footer style="text-align: center;">Developed By: Group-5: Sahil Chawla, Pankaj Kumar</footer> 
    </body>
</html>

