<?php

$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

$conn = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");

$s=$pdo->query("select * from categories");
$s->execute();
$data=$s->fetchAll();
if (isset($_POST['add_categorie'])) {
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
  

   $select_products = $pdo->prepare("SELECT * FROM `categories` WHERE nom_Categorie = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'le nom du produit existe déjà !';
   } else {
      $insert_products = $pdo->prepare("INSERT INTO `categories` (nom_Categorie) VALUES (?)");
      $insert_products->execute([$name]);

      if ($insert_products) {
         $message[] = 'nouveau produit ajouté !';
      }
   }
}
if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $pdo->prepare("DELETE FROM `categories` WHERE id_Categorie = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);

   header('location:categories.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../CSS/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">Ajouter un categorie</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Nom Categorie (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter nom Categorie" name="name">
         </div>
         
      
      <input type="submit" value="add product" class="btn" name="add_categorie">
   </form>

</section>

<section class="show-products">
   <h1 class="heading">Produits ajoutés.





.</h1>
   <div class="box-container">
   <?php
      $select_products = $pdo->prepare("SELECT * FROM `categories`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      
      <div class="name"><?= htmlspecialchars($fetch_products['nom_Categorie']); ?></div>
     
      <div class="flex-btn">
      <a href="update_categorie.php?update=<?= htmlspecialchars($fetch_products['id_Categorie']); ?>" class="option-btn">update</a>
         <a href="categories.php?delete=<?= htmlspecialchars($fetch_products['id_Categorie']); ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
   </div>
</section>
<!-- <section class="show-products">

   <h1 class="heading">Products Added.</h1>

   <div class="box-container">

   <?php
      // $select_products = $pdo->prepare("SELECT * FROM `products`");
      // $select_products->execute();
      // if($select_products->rowCount() > 0){
      //    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../<?= $fetch_products['img']; ?>" alt="">
      <div class="name"><?= $fetch_products['nom']; ?></div>
      <div class="price">Nrs.<span><?= $fetch_products['prix']; ?></span>/-</div>
      <div class="details"><span><?= $fetch_products['description']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
      //    }
      // }else{
      //    echo '<p class="empty">no products added yet!</p>';
      // }
   ?>
   
   </div>

</section>
 -->






<div class="loader">

</div>

<script src="../js/admin_script.js"></script>
<script src="js/loader.js"></script>

</body>
</html>