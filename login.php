<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sugargreen");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = trim($_POST['username']);
$password = $_POST['password'];
$role     = $_POST['role'];

$sql = "SELECT * FROM users WHERE email = ? OR full_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        if ($user['role'] === $role) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            switch ($role) {
                case 'admin': header("Location: admin.html"); break;
                case 'consumer': header("Location: consumer.html"); break;
                case 'seller': header("Location: seller.html"); break;
            }
            exit;
        } else {
            echo "<script>alert('Incorrect role selected.'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='login.html';</script>";
    }
} else {
    echo "<script>alert('User not found. Please register.'); window.location.href='register.html';</script>";
}
$stmt->close();
$conn->close();
?>
