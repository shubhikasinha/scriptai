<?php
$base = "/";
?>
<div class="navbar">

  <a href="/index.php" class="logo-link">
    <img src="img/logo.png" alt="ScriptAI" class="nav-logo">
  </a>

  <div id="hamburger" class="hamburger">
    ☰
  </div>

  <ul id="navLinks" class="nav-links">
    <li><a href="/index.php">Home</a></li>
    <li><a href="/about.php">About</a></li>
    <li class="dropdown">
      <a href="services.php">Services ▾</a>
      <ul class="dropdown-menu">
        <li><a href="/index.php#lta">Legal Tech Automation</a></li>
        <li><a href="/index.php#sd">Software Development</a></li>
        <li><a href="/index.php#wd">Web Development</a></li>
        <li><a href="/index.php#ui">UI/UX Design</a></li>
        <li><a href="/index.php#ma">Mobile App Development</a></li>
        <li><a href="/index.php#dm">Digital Marketing</a></li>
        <li><a href="/index.php#as">Analytics & Strategy</a></li>
        <li><a href="index.php#ch">Cloud Hosting</a></li>
      </ul>
    </li>
    <li><a href="/portfolio.php">Portfolio</a></li>
    <li><a href="/blog.php">Blogs</a></li>
    <li><a href="/contact.php">Reach Us</a></li>
  </ul>

  <!-- Move "Get Started" out of the nav links to act as the right-side button -->
  <a href="/register.php" class="header-cta">Get Started</a>

</div>