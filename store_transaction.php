<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to DB
$conn = new mysqli("localhost", "root", "", "sugargreen");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect shared fields
$seller_id = $_POST['seller_id'] ?? 0;
$method    = $_POST['method'] ?? '';

// Initialize all optional fields
$postal_address = $_POST['postal_address'] ?? null;
$postal_phone   = $_POST['postal_phone'] ?? null;
$postal_code    = $_POST['postal_code'] ?? null;
$postal_notes   = $_POST['postal_notes'] ?? null;

$bank_name      = $_POST['bank_name'] ?? null;
$account_number = $_POST['account_number'] ?? null;
$ifsc           = $_POST['ifsc'] ?? null;

$upi_id         = $_POST['upi_id'] ?? null;
$upi_app        = $_POST['upi_app'] ?? null;

// Insert query
$sql = "INSERT INTO transactions (
          seller_id, method,
          postal_address, postal_phone, postal_code, postal_notes,
          bank_name, account_number, ifsc,
          upi_id, upi_app
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Prepare failed: " . $conn->error);
}

// Bind values
$stmt->bind_param(
  "issssssssss",
  $seller_id, $method,
  $postal_address, $postal_phone, $postal_code, $postal_notes,
  $bank_name, $account_number, $ifsc,
  $upi_id, $upi_app
);

// Execute and redirect
if ($stmt->execute()) {
    header("Location: transaction.php?success=1");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
