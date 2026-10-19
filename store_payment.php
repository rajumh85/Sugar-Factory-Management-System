<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$conn = new mysqli("localhost", "root", "", "sugargreen");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form values
$name    = $_POST['name'] ?? '';
$address = $_POST['address'] ?? '';
$phone   = $_POST['phone'] ?? '';
$method  = $_POST['method'] ?? '';

// Prepare SQL
$sql = "INSERT INTO payments (name, address, phone, method) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssss", $name, $address, $phone, $method);

if ($stmt->execute()) {
    header("Location: thank_you.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
