<?php
// You can add session_start() or DB connection here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - ScriptAI Digital Services</title>
  <link rel="stylesheet" href="style.css?v=4">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

 <?php include 'header.php'; ?>

  <section class="ds-mini-hero fade-up">
    <h1>Get in Touch</h1>
    <p>Have a question or ready to start a project? Reach out to our team of experts.</p>
  </section>

  <section class="ds-content-section fade-up delay-1">
    <div class="ds-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 60px;">
      
      <!-- LEFT : CONTACT FORM -->
      <div class="ds-form-container" style="margin: 0; width: 100%;">
        <h3 style="margin-top: 0;">Send Us A Message</h3>
        <form>
          <div style="display: flex; gap: 15px;">
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Email Address" required>
          </div>
          <div style="display: flex; gap: 15px;">
            <input type="text" placeholder="Phone Number">
            <input type="text" placeholder="Your Address">
          </div>
          <textarea placeholder="Your Message" rows="5"></textarea>
          <button type="submit" class="ds-btn primary" style="width: 100%; justify-content: center; border: none; cursor: pointer; font-family: var(--font-heading);">
            Send Message
          </button>
        </form>
      </div>

      <!-- RIGHT : OFFICE DETAILS -->
      <div>
        <h3>Our Office</h3>
        <p style="color: var(--text-navy); font-weight: 500;"><i class="fas fa-phone-alt" style="color: var(--btn-purple); margin-right: 10px;"></i> +91-9253066656</p>
        <p style="color: var(--text-navy); font-weight: 500;"><i class="fas fa-envelope" style="color: var(--btn-purple); margin-right: 10px;"></i> info@scriptaidigital.com</p>
        <p style="color: var(--text-navy); font-weight: 500;"><i class="fas fa-map-marker-alt" style="color: var(--btn-purple); margin-right: 10px;"></i> H No. 5/1, Double Storey<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vijay Nagar, G.T.B Nagar<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delhi – 110009</p>

        <div style="margin-top: 30px; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
          <iframe
            src="https://www.google.com/maps?q=Vijay+Nagar+Delhi&output=embed"
            width="100%" height="250" style="border:0;"
            allowfullscreen="" loading="lazy">
          </iframe>
        </div>
      </div>

    </div>
  </section>

  <?php include 'footer.php'; ?>

  <script src="script.js"></script>
</body>
</html>
