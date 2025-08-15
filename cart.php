<?php
session_start(); // Start session to access logged-in user

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "ecommerce";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username']; // Get current username
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #2c2c2c;
            margin: 0;
            padding: 0;
            color: white;
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
            color: #f39c12;
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
            background: #333;
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
            color: #fff;
        }

        .item-details p {
            margin: 0.3rem 0;
            color: #bbb;
        }

        .cart-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .cart-actions strong {
            color: #f39c12;
            margin-bottom: 0.5rem;
        }

        .btn-remove {
            padding: 0.4rem 0.8rem;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 0.4rem;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-remove:hover {
            background: #c0392b;
        }

        .total-box {
            margin-top: 2rem;
            text-align: right;
            font-size: 1.5rem;
            font-weight: 700;
            color: black; /* Total cost in black */
        }

        .empty-cart {
            text-align: center;
            font-size: 1.5rem;
            color: #bbb;
            margin-top: 2rem;
        }

        .checkout-btn {
            padding: 0.7rem 1.5rem;
            background: #2ecc71;
            color: #fff;
            border: none;
            border-radius: 0.4rem;
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 2rem; /* Adds space between total and checkout button */
            cursor: pointer;
            transition: 0.3s ease;
            width: calc(100% - 4rem); /* Slightly smaller than full width, 2rem padding on both sides */
            max-width: 400px; /* Optional: set a max width if you want to limit the button width */
            display: block;
            margin-left: auto; /* Push the button to the right */
        }


        .checkout-btn:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>

<section class="cart-section">
    <h1 class="cart-title"><i class="fas fa-shopping-cart"></i> Your Shopping Cart</h1>

    <div class="cart-grid">
        <?php
        // Only fetch this user's cart items
        $stmt = $conn->prepare("SELECT * FROM cart WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $total = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;

                echo "
                <div class='cart-item'>
                    <img src='images/{$row['image']}' alt='{$row['name']}'>
                    <div class='item-details'>
                        <h3>{$row['name']}</h3>
                        <p>Price: \${$row['price']}</p>
                        <p>Quantity: {$row['quantity']}</p>
                    </div>
                    <div class='cart-actions'>
                        <strong>\$" . number_format($subtotal, 2) . "</strong>
                        <form method='POST' action='remove_from_cart.php'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' class='btn-remove'>Remove</button>
                        </form>
                    </div>
                </div>";
            }

            echo "<div class='total-box'>Total: \$" . number_format($total, 2) . "</div>";
            // Checkout button now below total with added space
            echo "<form method='POST' action='checkout.php'>
                    <button type='submit' class='checkout-btn'>Checkout</button>
                  </form>";
        } else {
            echo "<div class='empty-cart'>Your cart is empty 🛒</div>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</section>

</body>
</html>
