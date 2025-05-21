<?php
session_start();
// Check if user is logged in code here
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FRN. Gym</title>
  <link rel="stylesheet" href="front.css" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container nav-container">
      <div class="logo">frn.</div>
      <div class="menu-toggle" id="menuToggle">&#9776;</div>
      <ul class="nav-links" id="navLinks">
        <li><a href="#programs">Programs</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#signout">Sign Out</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-text fade-in">
      <h1>frn. Athletics</h1>
      <p>For those who can't</p>
    </div>
    <div class="hero-image"></div>
  </section>

  <!-- Image Section -->
<section class="about-us">
  <div class="about-image">
    <img src="2.webp" alt="Gym Facility" width="900px" />
  </div>
  <div class="about-text fade-in">
    <h2>About Us</h2>
    <p>
      At FRN. Gym, we believe that fitness is for everyone. Our mission is to create a welcoming environment where individuals of all backgrounds can pursue their health goals. With state-of-the-art equipment and dedicated trainers, we're here to support you every step of the way.
    </p>
  </div>
</section>i
  <dv class="fade-in">
    <h2>Our Programs</h2>
    <p>Explore our diverse range of fitness programs tailored for everyone.</p>
  </div>

  <!-- JavaScript for Scroll Animation -->
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
 