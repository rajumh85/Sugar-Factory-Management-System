<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sugargreen_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];

$sql = "SELECT * FROM users WHERE (email=? OR name=?) AND password=? AND role=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $username, $password, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    switch ($role) {
        case 'admin': header("Location: admin.html"); break;
        case 'consumer': header("Location: consumer.html"); break;
        case 'seller': header("Location: seller.html"); break;
    }
} else {
    echo "<script>alert('Invalid credentials'); window.location.href='login.html';</script>";
}

$stmt->close();
$conn->close();
?>
