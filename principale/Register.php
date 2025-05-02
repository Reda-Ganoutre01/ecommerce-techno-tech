
<?php
include('includ/connection.php');
if(isset($_POST['register'])){

    $username = strtolower($_POST['Username']);
    $email=$_POST['email'];
    $password=$_POST['password'];
    $repetpassword=$_POST['Repet_password'];

    $error=array();

    if(empty($username) OR empty($email) OR empty($password) OR empty($repetpassword)){

        array_push($error,"password does not match");
        if (!isset($message[0])) {
        $message[0]= 'All fields are required!';
        } else {
        $message[0].= 'All fields are required!';
        }

    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($error,"password does not match");

        if (!isset($message[0])) {
            $message[0]= ' Email is not valid!';
        } else {
            $message[0].= 'Email is not valid!';
        }

    }
    if(strlen($password)<8){
        array_push($error,"password does not match");
        if (!isset($message[0])) {
            $message[0]= 'password must be at 8 charactes';
        } else {
            $message[0].= 'password must be at 8 charactes';
        }

    }if($password !==$repetpassword ){
        array_push($error,"password does not match");

        if (!isset($message[0])) {
            $message[0]= 'password does not match';
        } else {
            $message[0].= 'password does not match';
        }


    }
    if(count($error)>0){
        
   
        
    }
    else{
         $check="SELECT * FROM client WHERE nom_client = '$username' OR email_client = '$email'";
         $checkResult = $conn->query($check);
           if($checkResult->num_rows>0){
            if (!isset($message[0])) {
                $message[0] = ' is alredy register!';
            } else {
                $message[0].= ' is alredy register!';
            }


           }
           else{
            require_once "includ/connection.php";
            $sql_insert="INSERT INTO client(nom_client,email_client,mod_pass_client) VALUES('$username','$email','$password')";
            if($conn->query($sql_insert)===TRUE){
              

                $message[] = 'Registration successful!';
                echo "<script>; window.location = 'login.php';</script>";
                exit();

            }else{
                if (!isset($message[0])) {
                    $message[0] = "ERROR". $sql_insert . "<br>" . $conn->error;
                } else {
                    $message[0].= "ERROR". $sql_insert . "<br>" . $conn->error;
                }
               


            }
           }
            
        }


};
?><!DOCTYPE html>
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
  <style>
     .alert-container {
        position: relative;
        margin-left: 10px;
    }
    
    .alert {
        padding: 5px 10px;
        background-color: #f44336;
        color: white;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .alert-sec {
        padding: 5px 10px;
        background-color: green;
        color: white;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .input-wrapper {
        margin-bottom: 10px;
    }
  </style>
    
<body>

<?php include("header.php");?>

<div class="wrapp">
     
    <h1 id="wrapp_title">Sign Up</h1>
        
    
            
            <form action='' method='POST' class='wrapp_form'>
            <input type="text" id='Username' name='Username'  placeholder='Username' id="wrapp_input"/>
            <input type="email" id='email' name='email' placeholder='email' id="wrapp_input"/>
            <input type="password" id='password' name='password' placeholder='new password' id="wrapp_input"/>
            <input type="password" id='password' name='Repet_password' placeholder='confirme password' id="wrapp_input"/>
            <button type="submit" name='register' id="wrapp_btn">Register</button>
          

          </form>
         
          <div class="member">
            Already a member? <a href='login.php' id="wrapp_a">Log Here</a>
          </div>
    </div>
    <?php include("footer.php"); ?> 
    </body>
  
</html>
