<?php

$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $pdo->prepare("DELETE FROM `client` WHERE id_client = ?");
   $delete_user->execute([$delete_id]);
   // $delete_orders = $pdo->prepare("DELETE FROM `orders` WHERE user_id = ?");
   // $delete_orders->execute([$delete_id]);
   // $delete_messages = $pdo->prepare("DELETE FROM `messages` WHERE user_id = ?");
   // $delete_messages->execute([$delete_id]);
   // $delete_cart = $pdo->prepare("DELETE FROM `cart` WHERE user_id = ?");
   // $delete_cart->execute([$delete_id]);
   // $delete_wishlist = $pdo->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   // $delete_wishlist->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../Css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">User accounts</h1>

   <div class="box-container">

   <?php
      $select_accounts = $pdo->prepare("SELECT * FROM `client`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> User id : <span><?= $fetch_accounts['id_client']; ?></span> </p>
      <p> Username : <span><?= $fetch_accounts['nom_client']; ?></span> </p>
      <p> Email : <span><?= $fetch_accounts['email_client']; ?></span> </p>
      <a href="users_accounts.php?delete=<?= $fetch_accounts['id_client']; ?>" onclick="return confirm('delete this account? the user related information will also be delete!')" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>