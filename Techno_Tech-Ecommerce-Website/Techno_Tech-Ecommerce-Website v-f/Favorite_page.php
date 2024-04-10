<?php 
    session_start(); // Start or resume the session
    $mess_client_2='';

    if (isset($_SESSION['email']) && isset($_SESSION['username'])){
        // Display a welcome message if session variables are set
        $mess_client_2='<h1>Hello, ' . htmlspecialchars($_SESSION['username']) . '!</h1><p>Welcome to the Favorite page.</p>';
    } else {
        // Redirect to the login page if session variables are not set
        header("Location: login.php");
        exit();
    }

   
    ?>   <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Techno Tech</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      

      />
    <link rel="icon" href="img/logo/logo rev.png" />
  </head>

  <body>  
    <?php
          include("header.php");
if (!empty($mess_client_2)){
  echo $mess_client_2;
}
    ?>
  
     <?php
         include("footer.php");

    ?>
  </body>
</html>
