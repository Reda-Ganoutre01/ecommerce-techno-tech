<?php 
    session_start(); // Start or resume the session
    $mess_client='';
$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");
  $nom='';
  $email=''; 
  $client_id = '';
    if (isset($_SESSION['email'])){
      $email=$_SESSION['email'];
    }
    if (isset($_SESSION['username'])){
      $nom=$_SESSION['username'];
    }
if(isset($_SESSION['id_client'])){
  $client_id = $_SESSION['id_client'];
}

if(isset($_POST['send'])){
 
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);
  $msg = $_POST['message'];
  $msg = filter_var($msg, FILTER_SANITIZE_STRING);

  $select_message = $pdo->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
  $select_message->execute([$name, $email, $number, $msg]);

  if($select_message->rowCount() > 0){
     $message[] = 'already sent message!';
  }else{

    $insert_message = $pdo->prepare("INSERT INTO `messages`(id_client, name, email, number, message) VALUES(?,?,?,?,?)");
    $insert_message->execute([$client_id, $name, $email, $number, $msg]);
    $message[] = 'message envoyé avec succès!';

  }

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

                <label for="email">Your Telephone:</label>
                <input type="text" id="tel" name="number" required >
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <input type="submit" name="send" value="Submit">
            </form>
            <div class="contact-info">
            <h3>Informations de contact</h3>
<p><strong>Adresse :</strong> 123 rue , Rabat, Maroc</p>
<p><strong>Email :</strong> TecnoTech@gmail.com</p>
<p><strong>Téléphone :</strong>+212 70 000 0000</p>
<p><strong>Horaires :</strong> Lun - Ven : 9:00 - 17:00</p>
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
