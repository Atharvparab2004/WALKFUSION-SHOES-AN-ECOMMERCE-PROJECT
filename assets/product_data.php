<?php
session_start(); // Important for session management

$host = "localhost";
$user = "root";
$password = "";
$db = "ecommerce";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all cart items from all customers
$sql = "SELECT * FROM cart ORDER BY username";
$result = $conn->query($sql);
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - View All Carts</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #f6f8fb;
            margin: 0;
            padding: 0;
        }

        .cart-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .cart-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 2rem;
        }

        .cart-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 0.5rem;
            margin-right: 1rem;
        }

        .item-details {
            flex: 1;
        }

        .item-details h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .item-details p {
            margin: 0.3rem 0;
            color: #777;
        }

        .cart-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .cart-actions strong {
            color: #27ae60;
            margin-bottom: 0.5rem;
        }

        .total-box {
            margin-top: 2rem;
            text-align: right;
            font-size: 1.5rem;
            font-weight: 700;
            color: #222;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.5rem;
            color: #999;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

<section class="cart-section">
    <h1 class="cart-title"><i class="fas fa-shopping-cart"></i> All Customers' Carts</h1>

    <div class="cart-grid">
        <?php
        // Fetch all cart items
        if ($result->num_rows > 0) {
            $currentCustomer = '';
            while ($row = $result->fetch_assoc()) {
                // If the customer changes, start a new customer section
                if ($currentCustomer !== $row['username']) {
                    if ($currentCustomer !== '') {
                        echo "</div>"; // Close the previous customer section
                    }
                    $currentCustomer = $row['username'];
                    echo "<div class='customer-section'><h3>Customer: " . htmlspecialchars($currentCustomer) . "</h3>";
                }

                // Calculate the subtotal for this cart item
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;

                echo "
                <div class='cart-item'>
                    <img src='images/{$row['image']}' alt='{$row['name']}'>
                    <div class='item-details'>
                        <h3>{$row['name']}</h3>
                        <p>Price: \${$row['price']}</p>
                        <p>Quantity: {$row['quantity']}</p>
                        <p><strong>Customer:</strong> {$row['username']}</p>
                    </div>
                    <div class='cart-actions'>
                        <strong>\$" . number_format($subtotal, 2) . "</strong>
                    </div>
                </div>
                ";
            }

            // Display the total at the bottom
            echo "<div class='total-box'>Total: \$" . number_format($total, 2) . "</div>";

        } else {
            echo "<div class='empty-cart'>No cart items found!</div>";
        }

        $conn->close();
        ?>
    </div>
</section>

</body>
</html>
