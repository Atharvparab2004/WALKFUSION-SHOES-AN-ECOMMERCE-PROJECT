<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #2c2c2c;
            margin: 0;
            padding: 0;
            color: white;
        }
        .confirmation-section {
            padding: 4rem 2rem;
            text-align: center;
        }
        .confirmation-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #f39c12;
        }
        .confirmation-message {
            font-size: 1.5rem;
            color: #bbb;
        }
    </style>
</head>
<body>

<section class="confirmation-section">
    <h1 class="confirmation-title">Order Confirmed</h1>
    <p class="confirmation-message">Thank you for your purchase! Your order has been processed successfully.</p>
</section>

</body>
</html>
