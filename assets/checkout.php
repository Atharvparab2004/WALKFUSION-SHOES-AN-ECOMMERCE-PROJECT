<?php
session_start(); // Start session to access logged-in user

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

// Redirect to payment options page
header("Location: payment.php");
exit();
?>
