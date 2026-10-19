<?php
$conn = new mysqli("localhost", "root", "", "sugargreen");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM transactions ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transactions | SugarGreen</title>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #eaf7ea;
    }

    header {
      background-color: #a5d6a7;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      font-family: 'Pacifico', cursive;
      font-size: 24px;
      color: #2e7d32;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .nav-links li a {
      text-decoration: none;
      color: #2e7d32;
      font-weight: bold;
    }

    .nav-links li a:hover {
      text-decoration: underline;
    }

    .container {
      max-width: 95%;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0, 128, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #2e7d32;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      animation: fadeIn 1s ease-in;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
      font-size: 14px;
    }

    th {
      background-color: #c8e6c9;
      color: #2e7d32;
    }

    tr:hover {
      background-color: #f1fff1;
      transition: background-color 0.3s;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<header>
  <div class="logo">🌿 SugarGreen</div>
  <ul class="nav-links">
    <li><a href="admin.html">Home</a></li>
    <li><a href="contact.html">Contact</a></li>
    <li><a href="about.html">About</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</header>

<div class="container">
  <h2>Transaction Records</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Seller ID</th>
      <th>Method</th>
      <th>Postal Address</th>
      <th>Postal Phone</th>
      <th>Postal Code</th>
      <th>Notes</th>
      <th>Bank Name</th>
      <th>Account No.</th>
      <th>IFSC</th>
      <th>UPI ID</th>
      <th>UPI App</th>
      <th>Time</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['seller_id']}</td>
                <td>{$row['method']}</td>
                <td>{$row['postal_address']}</td>
                <td>{$row['postal_phone']}</td>
                <td>{$row['postal_code']}</td>
                <td>{$row['postal_notes']}</td>
                <td>{$row['bank_name']}</td>
                <td>{$row['account_number']}</td>
                <td>{$row['ifsc']}</td>
                <td>{$row['upi_id']}</td>
                <td>{$row['upi_app']}</td>
                <td>{$row['transaction_time']}</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='13'>No transactions found.</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</div>

</body>
</html>
