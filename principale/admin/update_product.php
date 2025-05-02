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
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $categorie = $_POST['Nom_categorie'];
   $categorie = filter_var($categorie, FILTER_SANITIZE_STRING);
   $top = $_POST['top'];
   $top = filter_var($top, FILTER_SANITIZE_STRING);
   $nbr_star = $_POST['nbr_star'];
   $nbr_star = filter_var($nbr_star, FILTER_SANITIZE_STRING);

   $quantite_en_stock = $_POST['quantite_en_stock'];
   $quantite_en_stock = filter_var($quantite_en_stock, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_folder_01 = 'images/img_Products/' . $image_01;

   $update_product = $pdo->prepare("UPDATE `produits` SET nom = ?, prix = ?, description = ?,nbr_star= ?,top= ?
   ,Nom_categorie = ?,img = ?,quantite_en_stock = ?
   
   WHERE id = ?");
   $update_product->execute([$name, $price, $details, $nbr_star, $top, $categorie, $image_folder_01, $quantite_en_stock,$pid]);

   $message[] = 'product updated successfully!';

 

   

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

   <h1 class="heading">Modifier Product</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $pdo->prepare("SELECT * FROM `produits` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="../<?=$fetch_products['img']; ?>">
     
      <div class="image-container">
         <div class="main-image">
            <img src="../<?= $fetch_products['img']; ?>" alt="">
         </div>
         
      </div>
      <span>Update Nom</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['nom']; ?>">
      <span>Update prix</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['prix']; ?>">
      <span>Update description</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['description']; ?></textarea>
      <span>Update image</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>Update top</span>
      <input type="number" name="top" class="box" value="<?= $fetch_products['top']; ?>">


      <span>Update nbr de star</span>
      <input type="number" name="nbr_star" class="box" value="<?= $fetch_products['nbr_star']; ?>">

      <span>Update quantite en stock</span>
      <input type="number" name="quantite_en_stock" class="box" value="<?= $fetch_products['quantite_en_stock']; ?>">

      <span>Update quantite en stock</span>
<select name="Nom_categorie" id="" class="box">
      <?php 
$pdo=mysqli_connect('localhost','root','','ecom_db');
$s=mysqli_query($pdo,"select * from categories");
                        while($r=mysqli_fetch_array($s)) { 
                    ?>
                        
                        <option value="<?= $r['nom_Categorie'] ?>"><?= $r['nom_Categorie'] ?></option>   
                        
                          
                    <?php } ?>

</select>
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="products.php" class="option-btn">Go Back.</a>
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