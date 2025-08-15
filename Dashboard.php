<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ECommerce Website Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
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
      z-index: 1;
      background: rgba(255, 255, 255, 0.1);
      padding: 50px 60px;
      border-radius: 20px;
      backdrop-filter: blur(20px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
      text-align: center;
      animation: fadeIn 1s ease-in-out;
      max-width: 500px;
    }

    h1 {
      font-size: 36px;
      margin-bottom: 15px;
      color: #ffffff;
    }

    .subtitle {
      font-size: 18px;
      color: #dddddd;
      margin-bottom: 40px;
    }

    .button-group {
      display: flex;
      justify-content: center;
      gap: 25px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 15px 25px;
      font-size: 16px;
      font-weight: 600;
      color: white;
      background: linear-gradient(135deg, #ff9900, #ff6600);
      border: none;
      border-radius: 12px;
      text-decoration: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 5px 15px rgba(255, 102, 0, 0.5);
    }

    .btn i {
      margin-right: 10px;
    }

    .btn:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(255, 102, 0, 0.7);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</head>
<body>

  <div class="background-blur"></div>

  <div class="container">
    <h1><i class="fas fa-shopping-cart"></i> E-Commerce Dashboard</h1>
    <p class="subtitle">Choose your role to continue</p>
    <div class="button-group">
      <a href="AdminHome.php" class="btn"><i class="fas fa-user-shield"></i> Admin Panel</a>
      <a href="Login.php" class="btn"><i class="fas fa-user"></i> Customer Login</a>
    </div>
  </div>

</body>
</html>
