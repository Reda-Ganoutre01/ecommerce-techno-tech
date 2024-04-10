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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: rgb(150,150,250);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            
        }
        .title {

            color:black;

        }
        .ss{
            color:#fff
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
            background: rgb(17, 107, 143);
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
<div class="container">
    <h1 class="title">User Profile</h1>
    
    <div class="profile-info">
        <?php
        
        echo "<p class='ss'>Welcome, <strong>{$_SESSION['username']}</strong></p>";
        echo "<p class='ss'>Email: {$_SESSION['email']}</p>";
        ?>
    </div>

    <div class="btn-container">
        <button onclick="window.location.href='update_profile.php'">Update Profile</button>
        <!-- <button onclick="window.location.href='logout.php'" onclick="return confirm('logout from the website?');">Logout</button> -->
        <a href="logout.php"  onclick="return confirm('logout from the website?');">
        <button onclick="return confirm('logout from the website?');">Logout</button>

        </a> 

    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
