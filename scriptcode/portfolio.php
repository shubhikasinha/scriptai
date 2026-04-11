<?php
// You can add session_start() or DB connection here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Portfolio - ScriptAI Digital Services</title>
  <link rel="stylesheet" href="style.css?v=3">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body style="background: var(--bg-white);">
 <?php include 'header.php'; ?>

  <!-- Mini Hero -->
  <section class="ds-mini-hero fade-up">
    <h1>Our Portfolio</h1>
    <p>Projects that represent our creativity and engineering capabilities.</p>
  </section>

  <!-- Portfolio Grid -->
  <section class="ds-content-section fade-up delay-1">
    <div class="ds-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
      
      <div style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; padding: 20px;">
        <img src="https://via.placeholder.com/300x200/dbd6f2/6A28BF?text=Project+1" alt="Project 1" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
        <h3 style="margin-top: 20px; font-size: 20px;">Business Website</h3>
      </div>

      <div style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; padding: 20px;">
        <img src="https://via.placeholder.com/300x200/dbd6f2/6A28BF?text=Project+2" alt="Project 2" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
        <h3 style="margin-top: 20px; font-size: 20px;">E-Commerce Platform</h3>
      </div>

      <div style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; padding: 20px;">
        <img src="https://via.placeholder.com/300x200/dbd6f2/6A28BF?text=Project+3" alt="Project 3" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
        <h3 style="margin-top: 20px; font-size: 20px;">Portfolio Site</h3>
      </div>

      <div style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; padding: 20px;">
        <img src="https://via.placeholder.com/300x200/dbd6f2/6A28BF?text=Project+4" alt="Project 4" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
        <h3 style="margin-top: 20px; font-size: 20px;">Mobile App UI</h3>
      </div>

      <div style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; padding: 20px;">
        <img src="https://via.placeholder.com/300x200/dbd6f2/6A28BF?text=Project+5" alt="Project 5" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
        <h3 style="margin-top: 20px; font-size: 20px;">Startup Branding</h3>
      </div>

      <div style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; padding: 20px;">
        <img src="https://via.placeholder.com/300x200/dbd6f2/6A28BF?text=Project+6" alt="Project 6" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
        <h3 style="margin-top: 20px; font-size: 20px;">Landing Page</h3>
      </div>

    </div>
  </section>

 <?php include 'footer.php'; ?>

  <script src="script.js"></script>
</body>
</html>
