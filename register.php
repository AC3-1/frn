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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - FRN. Gym</title>
  <link rel="stylesheet" href="register.css" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container nav-container">
      <a href = "front.html"><div class="logo">frn.</div></a>
      <div class="menu-toggle" id="menuToggle">&#9776;</div>
      <ul class="nav-links" id="navLinks">
        <li><a href="#programs">Programs</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-text fade-in">
      <h1>Join FRN. Athletics</h1>
      <p>Start your fitness journey with us</p>
    </div>
    <div class="hero-image"></div>
  </section>

  <!-- Registration Form Section -->
  <section class="registration-section fade-in">
    <div class="form-container">
      <h2>Create Your Account</h2>

      <!-- Placeholder message (if needed) -->
      <!-- <div class="success-message">Registration successful!</div> -->
      <!-- <div class="error-message">Passwords do not match.</div> -->

      <form class="registration-form" action="register.php" method="post">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required />

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required />

        <button type="submit">Register Now</button>
      </form>
      <p class="login-link">Already a member? <a href="login.html">Login here</a></p>
    </div>
  </section>

  <!-- Scroll Animation Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const faders = document.querySelectorAll('.fade-in');
      const appearOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
      };

      const appearOnScroll = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (!entry.isIntersecting) return;
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        });
      }, appearOptions);

      faders.forEach(fader => {
        appearOnScroll.observe(fader);
      });
    });
  </script>

</body>
</html>
