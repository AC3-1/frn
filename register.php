<?php
$servername = "localhost";
$username = "root";        
$password = "12345";  // Password ng root         
$dbname = "frn_db";   
$port = 3306;     

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$raw_password = $_POST['password'] ?? '';

// Basic validation (optional but useful)
if (empty($name) || empty($email) || empty($raw_password)) {
  die("All fields are required.");
}

$password = password_hash($raw_password, PASSWORD_BCRYPT); // secure password hashing

// Check if email already exists
$check = $conn->prepare("SELECT * FROM Users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
  echo "Email already exists.";
} else {
  $stmt = $conn->prepare("INSERT INTO Users (name, email, password_hash, user_type) VALUES (?, ?, ?, 'member')");
  $stmt->bind_param("sss", $name, $email, $password);

  if ($stmt->execute()) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$check->close();
$conn->close();
?>
