<?php

session_start();


if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>User Profile</title>
    <style>
      :root{
  --primary-color: #334add;
  --main-color:#2980b9;
  --orange:#f39c12;
  --orange_pricipc:#ff523b;
  --red:#e74c3c;
  --black:#333;
  --white:#fff;
  --light-color:#666;
  --light-bg:#eee;
  --header-bg:#e3e6f3;

  --border:.2rem solid var(--black);
  --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
}
        .container_profile {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container_profile h1 {
            text-align: center;
            margin-bottom: 20px;
            
        }
        .container_profile .title {

            color:var(--black);

        }
        .ss{
            color:var(--main-color)
        }
        

        .profile-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-info p {
            margin: 10px 0;
        }

        .btn-container {
            text-align: center;
        }

        .btn-container button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            background: var(--primary-color);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-container button#log{
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            background: var(--orange_pricipc);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include("header.php"); ?>
<div class="container_profile">
    <h1 class="title">Profil utilisateur
</h1>
    
    <div class="profile-info">
        <?php
        
        echo "<p class='ss'>Bienvenue, <strong>{$_SESSION['username']}</strong></p>";
        echo "<p class='ss'>Email: {$_SESSION['email']}</p>";
        ?>
    </div>

    <div class="btn-container">
        <button onclick="window.location.href='update_profile.php'" >Modifier le profil</button>
        <a href="logout.php"  onclick="return confirm('logout from the website?');">
        <button onclick="return confirm('logout from the website?');" id="log">Déconnexion</button>

        </a> 

    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
