<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sugargreen";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Status</title>
    <style>
        body {
            margin: 0;
            background-color: #eefcee;
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #a3d9a5;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: green;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        .nav-links li a {
            text-decoration: none;
            color: darkgreen;
            font-weight: bold;
        }
        .register-container {
            margin-top: 60px;
            display: flex;
            justify-content: center;
        }
        .register-box {
            background-color: #dfffe1;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.4);
            width: 500px;
            text-align: center;
        }
        .success {
            color: green;
            font-weight: bold;
            font-size: 20px;
        }
        .error {
            color: red;
            font-weight: bold;
            font-size: 18px;
        }
        a.button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #2e7d32;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a.button:hover {
            background-color: #1b5e20;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">🌿 SugarGreen</div>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="about.html">About</a></li>
        </ul>
    </header>

    <div class="register-container">
        <div class="register-box">
            <?php
            // Check duplicate email
            $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                echo "<div class='error'>❌ This email is already registered.</div>";
                echo "<a href='login.html' class='button'>Go to Login</a>";
            } else {
                $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $password, $role);

                if ($stmt->execute()) {
                    echo "<div class='success'>✅ Registration Successful!</div>";
                    echo "<a href='login.html' class='button'>Go to Login</a>";
                } else {
                    echo "<div class='error'>❌ Error: " . $stmt->error . "</div>";
                }
                $stmt->close();
            }

            $check->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
