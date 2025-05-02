<?php

// include '../components/connect.php';
$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   
   $update_cate = $pdo->prepare("UPDATE `categories` SET nom_Categorie = ?
   WHERE id_Categorie = ?");
   $update_cate->execute([$name,$pid]);

   $message[] = 'product updated successfully!';
   if ($update_cate) {
    $message[] = 'product updated successfully!';
    header('location:categories.php');
       }
}

 

   



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">Update Product</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $pdo->prepare("SELECT * FROM `categories` WHERE id_Categorie = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
     
   <input type="hidden" name="pid" value="<?= $fetch_products['id_Categorie']; ?>">

      <span>Nom categorie</span>
      <input type="text" name="name" required class="box" maxlength="100"  value="<?= $fetch_products['nom_Categorie']; ?>">
      
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="categories.php" class="option-btn">Go Back.</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">no product found!</p>';
      }
   ?>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>