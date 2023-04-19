<?php
// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validate form data
    if (empty($fullName) || empty($email) || empty($message)) {
        $errorMsg = "Please fill in all the required fields.";
    } else {

        // Connect to database using PDO
        $dsn = 'mysql:host=localhost:3307;dbname=accounts';
       

        try {
            $pdo = new PDO("mysql:host=localhost:3307;dbname=accounts", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $errorMsg = "Failed to connect to database: " . $e->getMessage();
            exit();
        }

        // Prepare and execute SQL statement
        $stmt = $pdo->prepare("INSERT INTO contact_us (full_name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$fullName, $email, $message]);

        if ($stmt->rowCount() > 0) {
            $successMsg = "Your message has been sent successfully!";
        } else {
            $errorMsg = "Failed to send message. Please try again later.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Contact us</title>
</head>
  <?php include 'config/header.php'  ?>
<body>

      <h1 style="text-align: center;">Contact Us</h1>
     <?php if (isset($errorMsg)) { ?>
        <p style="color: red;"><?php echo $errorMsg; ?></p>
    <?php } elseif (isset($successMsg)) { ?>
        <p style="color: green;"><?php echo $successMsg; ?></p>
    <?php } ?>
    <div class="container my-4">

        <!-- Q: Create a contact us form that asks the user to input the following 3 required info (fields):
        o User’s Full Name
        o User’s Email
        o User’s Message  -->
        
    <form action="/Assignment-3/contact.php" method="post" >

    <div class="form-group">
        <label for="fullName">Full Name:</label>
        <input type="text" class="form-control" id="fullName" name="fullName" required>
        <br><br>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <br><br>
    </div>
        <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" name="message" class="form-control" required></textarea>
        <br><br>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
    </div>


    <footer style="text-align: center;">Developed By: Group-5: Sahil Chawla, Pankaj Kumar</footer> 
   
</body>
</html>