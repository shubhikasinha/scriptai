<?php
// You can add session_start() or DB connection here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - ScriptAI Digital Services for Digital Promotion</title>
<link rel="stylesheet" href="style.css?v=1">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

 <?php include 'header.php'; ?>

  <section class="contact-section">

<div class="container">

<h2>Get in Touch</h2>

<div class="contact-grid">

<!-- LEFT : CONTACT FORM -->

<div class="contact-form">

<form>

<div class="form-row">

<input type="text" placeholder="Your Name" required>
<input type="email" placeholder="Email Address" required>

</div>

<div class="form-row">

<input type="text" placeholder="Phone Number">
<input type="text" placeholder="Your Address">

</div>

<textarea placeholder="Your Message" rows="5"></textarea>

<button type="submit" class="contact-btn">
Send Message
</button>

</form>

</div>


<!-- RIGHT : OFFICE DETAILS -->

<div class="contact-info">

<h3>Our Office</h3>

<p><strong>Phone:</strong> +91-9253066656</p>
<p><strong>Email:</strong> info@scriptaidigital.com</p>

<p>
<strong>Address:</strong><br>
H No. 5/1, Double Storey<br>
Vijay Nagar, G.T.B Nagar<br>
Delhi – 110009
</p>

<div class="map-container">

<iframe
src="https://www.google.com/maps?q=Vijay+Nagar+Delhi&output=embed"
allowfullscreen
loading="lazy">
</iframe>

</div>

</div>

</div>

</div>

</section>
<?php include 'footer.php'; ?>
  <script src="script.js"></script>
</body>
</html>
