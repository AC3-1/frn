<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "12345";  // Password ng root
$dbname = "frn_db";
$port = 3306;

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get inputs
$email = $_POST['email'];
$password_input = $_POST['password'];

// Fetch user by email
$stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password_input, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['name'] = $user['name'];

        $stmt->close();
        $conn->close();

        session_write_close();

        // Login success
        header("Location: main.php");
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No account found with that email.";
}

$stmt->close();
$conn->close();
?>
