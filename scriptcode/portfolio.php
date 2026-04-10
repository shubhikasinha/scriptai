<?php
// You can add session_start() or DB connection here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Portfolio - ScriptAI Digital Services </title>
  <link rel="stylesheet" href="style.css?v=1">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
 <?php include 'header.php'; ?>

  <!-- Hero -->
  <header class="hero about-hero">
    <div class="overlay"></div>
    <div class="hero-content">
      <h1>Our Portfolio</h1>
      <p>Projects that represent our creativity and capabilities.</p>
    </div>
  </header>

  <!-- Portfolio Grid -->
  <section class="portfolio-grid">
    <div class="portfolio-item">
      <img src="https://via.placeholder.com/300x300/1e3c72/ffffff?text=Project+1" alt="Project 1">
      <h3>Business Website</h3>
    </div>
    <div class="portfolio-item">
      <img src="https://via.placeholder.com/300x300/2a5298/ffffff?text=Project+2" alt="Project 2">
      <h3>E-Commerce Platform</h3>
    </div>
    <div class="portfolio-item">
      <img src="https://via.placeholder.com/300x300/1e3c72/ffffff?text=Project+3" alt="Project 3">
      <h3>Portfolio Site</h3>
    </div>
    <div class="portfolio-item">
      <img src="https://via.placeholder.com/300x300/2a5298/ffffff?text=Project+4" alt="Project 4">
      <h3>Mobile App UI</h3>
    </div>
    <div class="portfolio-item">
      <img src="https://via.placeholder.com/300x300/1e3c72/ffffff?text=Project+5" alt="Project 5">
      <h3>Startup Branding</h3>
    </div>
    <div class="portfolio-item">
      <img src="https://via.placeholder.com/300x300/2a5298/ffffff?text=Project+6" alt="Project 6">
      <h3>Landing Page</h3>
    </div>
  </section>


 <?php include 'footer.php'; ?>

  <script src="script.js"></script>
</body>
</html>
