

<?php
session_start();

if(isset($_SESSION['username'])) {
    header("Location: Profile.php");
    exit();
}

if(isset($_POST['login'])) {
    include('includ/connection.php');
    
    $email = strtolower($_POST["email"]);
    $password = strtolower($_POST["password"]);
   
    if(empty($email)) {
        $email_error = "Please insert Email";
        if (!isset($message[0])) {
            $message[0]= 'Please insert Email';
        } else {
            $message[0].= 'Please insert Email';
        }
    }

    if(empty($password)) {
        $password_error = "Please insert password";
        if (!isset($message[0])) {
            $message[0] = 'Please insert password';
        } else {
            $message[0] .= ' Please insert password';
        }
        

    }

   
   
    

    if(!isset($email_error) && !isset($password_error)) {
        $sql = "SELECT * FROM client WHERE email_client='$email' AND mod_pass_client='$password' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if($row && $row['email_client'] === $email && $row['mod_pass_client'] === $password) {
            $_SESSION['username'] = $row['nom_client'];
            $_SESSION['email'] = $row['email_client'];
            $_SESSION['id_client'] = $row['id_client'];
            header("Location: Profile.php");
            $message[0]= 'Your password or email is incorrect!';

            exit();
        } else {
            $message[0]= 'Your password or email is incorrect!';

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
    <title>Login</title>
    <style>
     .alert {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 18px;
            line-height: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }

        .error-message {
            color: #fff;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>    
    
</head>
<body>
<?php include("header.php"); ?>
<div class="wrapp">
    <h1 id="wrapp_title">Sign In</h1>
    
    <form action='' method='POST' class='wrapp_form'>
        <div>
            <input type="text" id='email' name='email' placeholder='email' class='login-input' value="bgamoutre52111@gmail.com"/>
            
        </div>
        <div>
            <input type="password" id='password' name='password' placeholder='password' class='login-input' value="bgamoutre52111@gmail.com"/>
           
        </div>
        <button type='submit'  name='login' id="wrapp_btn">Log in</button>
    </form>
    <div class="member">
        Not a member? <a href='Register.php'>Register Now</a>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
