<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "sugargreen");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';
$image_url = $_POST['image_url'] ?? '';
$description = $_POST['description'] ?? '';

$sql = "INSERT INTO products (name, price, image_url, description) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Prepare failed: " . $conn->error);
}

$stmt->bind_param("sdss", $name, $price, $image_url, $description);

if ($stmt->execute()) {
    echo "<script>alert('✅ Product added successfully!'); window.location.href='products-box.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
