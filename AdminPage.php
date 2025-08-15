<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - ECommerce Website</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            font-family: 'Nunito', sans-serif;
            background-color: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: #fff;
            position: relative;
        }

        .background-blur {
            position: absolute;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            z-index: 1;
        }

        .card {
            background-color: #1c1c1c;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(255, 159, 26, 0.2);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            margin-bottom: 25px;
            color: #fff; /* Changed to white */
            font-size: 28px;
        }

        .nav-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .nav-buttons a {
            padding: 10px 18px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            background-color: #ff9f1a;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .nav-buttons a:hover {
            background-color: #e68a00;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="background-blur"></div>
    <div class="container">
        <div class="card">
            <h1>Welcome Admin</h1>
            <div class="nav-buttons">
                <a href="customer_dashboard.php">Customer Dashboard</a>
                <a href="product_data.php">Product Data</a>
            </div>
        </div>
    </div>
</body>
</html>
