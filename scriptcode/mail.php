<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - BrightEdge</title>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>

  <?php include 'header.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "dharamvirbainda@gmail.com";
    $subject = "New Contact Message from BrightEdge Website";
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $address = htmlspecialchars($_POST["address"]);
    $message = htmlspecialchars($_POST["message"]);

    $body = "Name: $name\nEmail: $email\nPhone: $phone\nAddress: $address\n\nMessage:\n$message";

    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent!";
    } else {
        echo "Mail failed.";
    }
}
?>
<?php include 'footer.php'; ?>

  <script src="script.js"></script>
</body>
</html>
