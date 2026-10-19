<?php
// Enable error display
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$conn = new mysqli("localhost", "root", "", "sugargreen");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch payments
$sql = "SELECT id, name, address, phone, method, submitted_at FROM payments ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payments | SugarGreen</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0fff0;
      margin: 0;
    }

    header {
      background-color: #a5d6a7;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 24px;
      font-family: 'Pacifico', cursive;
      color: #2e7d32;
    }

    nav a {
      margin-left: 20px;
      text-decoration: none;
      color: #2e7d32;
      font-weight: bold;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #2e7d32;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #e8f5e9;
      color: #2e7d32;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f8f2;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">🌿 SugarGreen</div>
  <nav>
    <a href="admin-dashboard.html">Dashboard</a>
    <a href="login.html">Logout</a>
  </nav>
</header>

<div class="container">
  <h2>Consumer Details</h2>

  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Method</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td><?= htmlspecialchars($row['method']) ?></td>
            <td><?= htmlspecialchars($row['submitted_at']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No payments found.</p>
  <?php endif; ?>

</div>

</body>
</html>

<?php
$conn->close();
?>
