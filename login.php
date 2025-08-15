<?php
session_start();

// Database connection
$host = "localhost";
$user = "root"; // Update if needed
$pass = "";     // Update if needed
$dbname = "ecommerce";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Flash message handler
function flash($msg) {
    echo "<script>alert('$msg');</script>";
}

// Handle Registration
if (isset($_POST['register'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $gender = $_POST['gender'];
    $rdate = date("Y-m-d");
    $mob = mysqli_real_escape_string($conn, $_POST['mob']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hash

    // Check if username exists
    $check = mysqli_prepare($conn, "SELECT id FROM customer WHERE username = ?");
    mysqli_stmt_bind_param($check, "s", $username);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        flash("Username already exists. Try another.");
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO customer (fname, lname, gender, rdate, mob, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $gender, $rdate, $mob, $email, $username, $password);
        if (mysqli_stmt_execute($stmt)) {
            flash("Registration successful! Please login.");
        } else {
            flash("Error during registration.");
        }
    }
}

// Handle Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT password FROM customer WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.html");
            exit();
        } else {
            flash("Incorrect password.");
        }
    } else {
        flash("Username not found.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website | Customer Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); /* Gradient background for the page */
            color: white;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.5); /* Slightly transparent black background for the form */
            border-radius: 10px;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Adding a subtle shadow for depth */
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            background: rgba(255, 255, 255, 0.7);
            color: black;
            border-radius: 8px;
        }

        input[type="submit"] {
            background-color: #ff9f1a;
            cursor: pointer;
            font-weight: bold;
            color: white;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #e68a00;
        }

        h2 {
            text-align: center;
            color: white;
            margin-bottom: 15px;
        }

        hr {
            border: 0.5px solid #aaa;
            margin: 20px 0;
        }

        label {
            color: white;
        }

        /* New Title Styling */
        .page-title {
            text-align: center;
            color: #ff9f1a;
            font-size: 32px;
            margin-top: 50px;
            font-weight: bold;
        }

        @media (max-width: 500px) {
            .form-box {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Title added -->
<div class="page-title">Ecommerce Website Customer Login</div>

<div class="container">
    <div class="form-box">
        <h2>Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="submit" name="login" value="Login" />
        </form>

        <hr>

        <h2>Register</h2>
        <form method="post">
            <input type="text" name="fname" placeholder="First Name" required />
            <input type="text" name="lname" placeholder="Last Name" required />
            <select name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
            <input type="text" name="mob" placeholder="Mobile Number" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="submit" name="register" value="Register" />
        </form>
    </div>
</div>

</body>
</html>
