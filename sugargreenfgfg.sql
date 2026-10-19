-- Create the database
CREATE DATABASE IF NOT EXISTS sugargreen;
USE sugargreen;

-- Table: users (for register & login)
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'consumer', 'seller') NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- Table: seller_details (for seller.html submission)
CREATE TABLE IF NOT EXISTS seller_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    userId VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    kg INT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: transactions
CREATE TABLE IF NOT EXISTS transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  seller_id INT NOT NULL,
  method VARCHAR(50) NOT NULL,
  
  -- Postal Fields
  postal_address TEXT,
  postal_phone VARCHAR(20),
  postal_code VARCHAR(10),
  postal_notes TEXT,

  -- Bank Fields
  bank_name VARCHAR(100),
  account_number VARCHAR(30),
  ifsc VARCHAR(20),

  -- UPI Fields
  upi_id VARCHAR(50),
  upi_app VARCHAR(50),

  transaction_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- Table: products (for consumer product view)
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  image_url TEXT,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Table: orders
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
CREATE TABLE IF NOT EXISTS payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  address TEXT NOT NULL,
  phone VARCHAR(20) NOT NULL,
  method VARCHAR(50) NOT NULL,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  phone VARCHAR(20) NOT NULL,
  role VARCHAR(50) NOT NULL,
  added_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);