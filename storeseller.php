<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "sugargreen");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name    = $_POST['name'];
$userId  = $_POST['userId'];
$phone   = $_POST['phone'];
$email   = $_POST['email'];
$address = $_POST['address'];
$kg      = $_POST['kg'];

$sql = "INSERT INTO seller_details (name, userId, phone, email, address, kg) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssi", $name, $userId, $phone, $email, $address, $kg);

if ($stmt->execute()) {
    header("Location: transaction.html");
    exit();
} else {
    echo "Execution failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
