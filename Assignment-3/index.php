<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'config/dbconfig.php';

    $email = $_POST["email"]; 
    $password = $_POST["password"];

    // Prepare a select statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");


    // Bind variables to the prepared statement as parameters
    

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

        
    // Attempt to execute the prepared statement
    $stmt->execute();

    // Check if a row was returned
    if ($stmt->rowCount() == 1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;

        //Q: redirect them immediately to the member page (member.php)
        header("location:member.php");

    } 
    else{
        $showError = "Invalid Credentials";
    }
}
?>


<!-- Q: Create a simple HTML content to welcome the user and simple paragraph to explain your
assignment
 -->

<!doctype html>
 <html lang="en">
  <head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--here is Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <!-- this is the header -->
  <?php require "config/header.php" ?>

    <?php
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>
    
 
    <div class="container my-4">
     <h1 class="text-center">Login Here</h1>
     <!-- Q: create a login form that is consisted of 
two input fields:
▪ Email ➔ of type email
▪ Password ➔ of type password
 -->
     <form action="/Assignment-3/index.php" method="post">

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required aria-describedby="emailHelp">
             </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
         
        <button type="submit" class="btn btn-primary">Login</button>

     </form>
    </div>

    <!-- Optional JavaScript bootstrap -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   
    <footer style="text-align: center;">Developed By: Group-5: Sahil Chawla, Pankaj Kumar</footer> 
</body>
 
</html>
