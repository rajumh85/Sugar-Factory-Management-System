<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Seller Details | SugarGreen</title>
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
    }

    h2 {
      color: #2e7d32;
      text-align: center;
      margin-bottom: 30px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
    }

    .seller-card {
      background: #ffffff;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .seller-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .seller-card h3 {
      color: #2e7d32;
      margin-top: 0;
    }

    .seller-card p {
      margin: 6px 0;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">🌿 SugarGreen</div>
  <nav>
    <a href="admin.html">Dashboard</a>
    <a href="login.html">Logout</a>
  </nav>
</header>

<div class="container">
  <h2>Seller Details</h2>
  <div class="grid" id="sellerGrid">
    <!-- Seller cards will be inserted here via PHP -->
    <?php include 'fetch_sellers.php'; ?>
  </div>
</div>

</body>
</html>
