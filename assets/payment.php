<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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

$username = $_SESSION['username'];
$total = 0;

$stmt = $conn->prepare("SELECT * FROM cart WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Options</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #2c2c2c;
            margin: 0;
            padding: 0;
            color: white;
        }

        .payment-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #f39c12;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin: 2rem auto 1rem auto;
            text-decoration: none;
            background: #3498db;
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 0.4rem;
            font-weight: 600;
            width: fit-content;
            transition: background 0.3s ease;
        }

        .btn-back:hover {
            background: #2980b9;
        }

        .cart-items {
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        .cart-item {
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #444;
            border-radius: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item p {
            margin: 0;
            color: #ccc;
        }

        .item-name {
            font-weight: 600;
        }

        .item-price, .item-quantity {
            font-size: 1.1rem;
            color: #f39c12;
        }

        .total-box {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin: 2rem 0 1rem 0;
            color: #fff;
        }

        .payment-wrapper {
            max-width: 500px;
            margin: auto;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .payment-label {
            display: block;
            background-color: #444;
            padding: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
        }

        .payment-label:hover {
            background-color: #555;
        }

        .payment-label input[type="radio"] {
            margin-right: 0.5rem;
        }

        .payment-label.active {
            border-color: #f39c12;
            background-color: #555;
        }

        .payment-icon {
            font-size: 1.5rem;
            color: #f39c12;
            margin-right: 0.5rem;
        }

        .payment-desc {
            font-size: 0.95rem;
            color: #ccc;
            margin-top: 0.5rem;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .payment-label.active .payment-desc {
            max-height: 100px;
            opacity: 1;
        }

        .btn-pay {
            padding: 0.7rem 1.5rem;
            background: #2ecc71;
            color: #fff;
            border: none;
            border-radius: 0.4rem;
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 1rem;
            cursor: pointer;
            transition: 0.3s ease;
            width: 100%;
        }

        .btn-pay:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>

<section class="payment-section">
    <h2 class="section-title">Product Details</h2>
    <div class="cart-items">
        <?php foreach ($cartItems as $item): ?>
            <div class="cart-item">
                <div>
                    <p class="item-name"><?php echo $item['name']; ?></p>
                    <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                    <p class="item-quantity">Quantity: <?php echo $item['quantity']; ?></p>
                </div>
                <div>
                    <p class="item-price">Subtotal: $<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- 🔙 Back to Cart Button here -->
    <a href="cart.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Cart</a>

    <!-- 💰 Total -->
    <div class="total-box">
        <p>Total Amount: <strong>$<?php echo number_format($total, 2); ?></strong></p>
    </div>

    <h2 class="section-title">Choose Payment Method</h2>
    <div class="payment-wrapper">
        <form class="payment-options" method="POST" action="process_payment.php">
            <label class="payment-label" data-method="credit_card">
                <input type="radio" name="payment_method" value="credit_card" required>
                <i class="fas fa-credit-card payment-icon"></i> Credit Card
                <div class="payment-desc">Pay securely with your credit card.</div>
            </label>

            <label class="payment-label" data-method="upi">
                <input type="radio" name="payment_method" value="upi">
                <i class="fas fa-mobile-alt payment-icon"></i> UPI
                <div class="payment-desc">Pay using UPI apps like Google Pay or PhonePe.</div>
            </label>

            <label class="payment-label" data-method="cash_on_delivery">
                <input type="radio" name="payment_method" value="cash_on_delivery">
                <i class="fas fa-wallet payment-icon"></i> Cash on Delivery
                <div class="payment-desc">Pay in cash when your order is delivered.</div>
            </label>

            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button type="submit" class="btn-pay">Proceed to Pay</button>
        </form>
    </div>
</section>

<script>
    const labels = document.querySelectorAll('.payment-label');

    labels.forEach(label => {
        const input = label.querySelector('input[type="radio"]');
        input.addEventListener('change', () => {
            labels.forEach(l => l.classList.remove('active'));
            label.classList.add('active');
        });
    });
</script>

</body>
</html>
