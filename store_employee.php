<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = new mysqli("localhost", "root", "", "sugargreen");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name  = $_POST['emp_name'] ?? '';
$email = $_POST['emp_email'] ?? '';
$phone = $_POST['emp_phone'] ?? '';
$role  = $_POST['emp_role'] ?? '';

// Insert query
$sql = "INSERT INTO employees (name, email, phone, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssss", $name, $email, $phone, $role);

if ($stmt->execute()) {
    echo "<script>alert('✅ Employee added successfully!'); window.location.href='employees-box.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
