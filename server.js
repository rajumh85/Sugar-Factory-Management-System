const express = require("express");
const mysql = require("mysql2");
const path = require("path");
const bodyParser = require("body-parser");
require("dotenv").config();

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static("public"));

// MySQL connection
const db = mysql.createConnection({
  host: "localhost",
  user: "root",           // This matches your screenshot
  password: "",           // Leave blank since no password is set
  database: "sugargreen"  // You need to create this database
});

db.connect(err => {
  if (err) throw err;
  console.log("✅ Connected to MySQL database.");
});

// Register route
app.post("/register", (req, res) => {
  const { name, email, password, role } = req.body;
  const sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
  db.query(sql, [name, email, password, role], (err) => {
    if (err) throw err;
    res.send("Registration successful. <a href='login.html'>Login Now</a>");
  });
});

// Login route
app.post("/login", (req, res) => {
  const { username, password, role } = req.body;
  const sql = "SELECT * FROM users WHERE email = ? AND password = ? AND role = ?";
  db.query(sql, [username, password, role], (err, results) => {
    if (err) throw err;

    if (results.length > 0) {
      if (role === "admin") {
        res.redirect("/admin.html");
      } else {
        res.redirect("/consumer.html");
      }
    } else {
      res.send("Invalid credentials or role.");
    }
  });
});

app.listen(port, () => {
  console.log(`🚀 Server running at http://localhost:${port}`);
});
