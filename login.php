<?php
session_start();

// Only process the form if it was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "12345";  // Password for root
    $dbname = "frn_db";
    $port = 3306;

    // Connect to DB
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
    } else {
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
                $_SESSION['user_id'] = $user['user_ID']; // Changed from 'id' to 'user_ID' to match your DB schema
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['name'] = $user['name'];

                $stmt->close();
                $conn->close();

                // Login success - redirect based on user type
                if ($user['user_type'] == 'employee') {
                    header("Location: employee1.html"); // Redirect to employee scheduler
                } else {
                    header("Location: main.php"); // Redirect to member page
                }
                exit();
            } else {
                $error_message = "Incorrect password.";
            }
        } else {
            $error_message = "No account found with that email.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - FRN. Gym</title>
  <link rel="stylesheet" href="register.css" />
  <style>
    /* Add some styles for error messages */
    .error-message {
      background-color: #fee2e2;
      color: #b91c1c;
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 20px;
      text-align: center;
    }
    
    .success-message {
      background-color: #d1fae5;
      color: #065f46;
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container nav-container">
      <a href="front.html"><div class="logo">frn.</div></a>
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
      <h2>Login To Your Account</h2>

      <?php if (isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
      <?php endif; ?>
      
      <?php if (isset($_GET['registered']) && $_GET['registered'] == 'success'): ?>
        <div class="success-message">Registration successful! Please login.</div>
      <?php endif; ?>

      <form class="registration-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />

        <button type="submit">Login</button>
      </form>
      <p class="login-link">Not a member? <a href="register.html">Register here</a></p>
    </div>
  </section>

  <!-- Scroll Animation Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Toggle mobile menu
      const menuToggle = document.getElementById('menuToggle');
      const navLinks = document.getElementById('navLinks');
      
      if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
          navLinks.classList.toggle('active');
        });
      }
      
      // Fade-in animation
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