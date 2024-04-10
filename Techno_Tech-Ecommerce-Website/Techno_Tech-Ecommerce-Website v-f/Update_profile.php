<?php
 
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if(isset($_POST['update'])) {
   
    include('includ/connection.php');


    $newUsername = $_POST["newUsername"];
    $newPassword = $_POST["newPassword"];

    if(empty($newUsername)) {
        $username_error = "<p class='empty'>Please insert Username</p>";
    }

    if(empty($newPassword)) {
        $password_error = "<p class='empty'>Please insert new password</p>";
    }

    
    if(!isset($username_error) && !isset($password_error)) {
        $email = $_SESSION['email'];
        $sql = "UPDATE client SET nom_client='$newUsername', mod_pass_client='$newPassword' WHERE email_client='$email'";
        $result = mysqli_query($conn, $sql);

        if($result) {
            
            $_SESSION['username'] = $newUsername;
          
            header("Location: Profile.php");
            exit();
        } else {
            $mess= "<p>Failed to update profile</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: rgb(150,150,250);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-input {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
            outline: none;
        }

        .profile-input:focus {
            border-color: #45a049;
        }

        #update_btn {
            width: 50%;
            padding: 10px 0;
            background: rgb(17, 107, 143);
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #update_btn:hover {
            background-color: #357933;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php include("header.php"); ?>
<div class="container">
    <h1>Update Profile</h1>
    
    <form action='' method='POST' class='profile-form'>
        <?php if(isset($username_error)) { echo $username_error; } ?>
        <input type="text" id='newUsername' name='newUsername' placeholder='New Username' class='profile-input'/>
        <?php if(isset($password_error)) { echo $password_error; } ?>
        <input type="password" id='newPassword' name='newPassword' placeholder='New Password' class='profile-input'/>
        <button type='submit' name='update' id="update_btn">Update</button>
    </form>
</div>
<?php include("footer.php"); ?>
</body>
</html>
