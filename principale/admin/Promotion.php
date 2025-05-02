<?php

$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

$conn = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");
$produit_id=$pdo->query("select * from produits");
$produit_id->execute();
$data_produit_id=$produit_id->fetchAll();



if (isset($_POST['add_promotion'])) {
   $id = $_POST['id_produit'];
   $id = filter_var($id, FILTER_SANITIZE_STRING);
   $date_debut = $_POST['date_debut'];
   $date_debut = filter_var($date_debut, FILTER_SANITIZE_STRING);
   
   $date_fin = $_POST['date_fin'];
   $date_fin = filter_var($date_fin, FILTER_SANITIZE_STRING);

   $nouveau_prix = $_POST['nouveau_prix'];
   $nouveau_prix = filter_var($nouveau_prix, FILTER_SANITIZE_STRING);

   $select_products = $pdo->prepare("SELECT * FROM `promotion` WHERE produit_id = ?");
   $select_products->execute([$id]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'le produit  existe déjà dans la promotio!';
   } else {
      $insert_products_pro = $pdo->prepare("INSERT INTO `promotion` (produit_id, date_debut , date_fin, nouveau_prix) VALUES (?, ?, ?, ?)");
      $insert_products_pro->execute([$id, $date_debut, $date_fin, $nouveau_prix]);

      if ($insert_products_pro) {
         $message[] = 'nouveau promotion ajouté !';
      }
   }
}
if(isset($_GET['delete_promotin'])){

   $delete_id = $_GET['delete_promotin'];
   $delete_product_image = $pdo->prepare("DELETE FROM `promotion` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   
   header('location:Promotion.php');
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
<style>
   del {
  text-decoration: line-through; /* Strikethrough text */
  color: black; 
  opacity: 0.5;
}
</style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">Ajouter une Promotion</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
       
        <div class="inputBox">
            <span>Id Produit (required)</span>
            <select name="id_produit"  class="box">
              
               <?php foreach($data_produit_id as $r) { ?>
                        <option value="<?= $r['id'] ?>">  <?= $r['id'].' '.$r['nom'] ?></option>
                    <?php } ?>
            </select>
        </div>
       
        <div class="inputBox">
            <span>date_debut(required)</span>
            <input type="date" name="date_debut"  class="box" required>
        </div>
        <div class="inputBox">
            <span>date_fin(required)</span>
            <input type="date" name="date_fin"  class="box" required>
        </div>
   
         <div class="inputBox">
            <span>nouveau prix (required)</span>
            <input type="number" name="nouveau_prix"  class="box" required>

         </div>
      </div>
      
      <input type="submit" value="add product" class="btn" name="add_promotion">
   </form>

</section>

<section class="show-products">
   <h1 class="heading">Promotion ajoutés.





.</h1>
   <div class="box-container">
   <?php
      $select_products = $pdo->prepare("SELECT * FROM `promotion`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../<?= htmlspecialchars($fetch_products['produit_img']); ?>" alt="">
      <div class="name"><?= htmlspecialchars($fetch_products['produit_nom']); ?></div>
      <div class="price">
 <center>
     prix:<span><?= htmlspecialchars($fetch_products['nouveau_prix']); ?></span>,00 MAD<br>
   
         <del><?= htmlspecialchars($fetch_products['Ancien_prix']); ?>,00 MAD</del>
 </center>
    

   </div>

      <!-- <div class="details"><span><?= htmlspecialchars($fetch_products['']); ?></span></div> -->
      <div class="flex-btn">
         <a href="update_promotion.php?update=<?= htmlspecialchars($fetch_products['id']); ?>" class="option-btn">update</a>
         <a href="Promotion.php?delete_promotin=<?= htmlspecialchars($fetch_products['id']); ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
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