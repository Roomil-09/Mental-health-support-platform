<?php
session_start();
session_destroy(); // Destroy all session data

// Display an alert message indicating logout
echo '<script>alert("You have been logged out.");</script>';

// Delay the redirection to allow the alert message to be displayed
echo '<script>setTimeout(function() { window.location.href = "home.php"; }, 100);</script>';
?>
