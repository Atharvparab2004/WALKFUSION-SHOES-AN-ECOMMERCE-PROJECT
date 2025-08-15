<?php
session_start(); // Start the session to access the username

$host = "localhost";
$user = "root";
$password = "";
$db = "ecommerce";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$name = $_POST['name'] ?? null;
$price = $_POST['price'] ?? null;
$quantity = $_POST['quantity'] ?? 1;
$image = $_POST['image'] ?? null;
$username = $_SESSION['username'] ?? null; // Get logged-in username

if ($name && $price && $image && $username) {
    $stmt = $conn->prepare("INSERT INTO cart (name, price, quantity, image, username) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdiss", $name, $price, $quantity, $image, $username); // s=string, d=double, i=int, s=string, s=string
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: cart.php");
    exit();
} else {
    echo "Product data or username missing!";
}
?>



