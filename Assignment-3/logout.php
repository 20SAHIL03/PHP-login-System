<?php
session_start();

// Clear session variables
session_unset();
session_destroy();

// Redirect to the home page
header("Location: index.php");
return;
?>
