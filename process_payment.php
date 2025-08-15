<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$payment_method = $_POST['payment_method'];
$total = $_POST['total'];

// Simulate the payment process (in a real application, you would integrate with payment gateways)
echo "<h1>Processing Payment...</h1>";
echo "<p>Payment Method: " . htmlspecialchars($payment_method) . "</p>";
echo "<p>Total: $" . number_format($total, 2) . "</p>";

// Here you would typically save the order to your database
// For now, just redirect the user to an order confirmation page

header("Location: order_confirmation.php");
exit();
?>
