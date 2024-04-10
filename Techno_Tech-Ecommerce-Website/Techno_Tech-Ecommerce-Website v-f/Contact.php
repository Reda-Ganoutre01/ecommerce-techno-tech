<?php 
    session_start(); // Start or resume the session
    $mess_client='';
$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");
  $nom='';
  $email='';
    if (isset($_SESSION['email'])){
      $email=$_SESSION['email'];
    }
    if (isset($_SESSION['username'])){
      $nom=$_SESSION['username'];
    }
    

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Techno Tech</title>
    <link rel="stylesheet" href="CSS/style_contact.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      

      />
    <link rel="icon" href="img/logo/logo rev.png" />
    <link rel="stylesheet" href="CSS/aos.css" />

  </head>

  <body>  
    <?php include("header.php");?>
    <div class="container" data-aos="zoom-in">
        <h1>Contact Us</h1>
        <div class="contact-form">
            <form action="#" method="POST">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required value=<?php echo   $nom; ?>>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required value=<?php echo   $email; ?>>

                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <input type="submit" value="Submit">
            </form>
            <div class="contact-info">
                <h3>Contact Information</h3>
                <p><strong>Address:</strong> 123 Main St, City, Country</p>
                <p><strong>Email:</strong> example@example.com</p>
                <p><strong>Phone:</strong> +212 634 567 890</p>
                <p><strong>Hours:</strong> Mon - Fri: 9:00 AM - 5:00 PM</p>
            </div>
        </div>
    </div>



<?php
include("footer.php");
    ?> 
    <script src="js/aos.js"></script>
  <script>
    AOS.init({
      offset:100,
      duration:1450,
    });
  </script>  
  </body>
</html>
