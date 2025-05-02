<?php

// include '../components/connect.php';
$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
$conn = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");
$produit_id=$pdo->query("select * from produits");
$produit_id->execute();
$data_produit_id=$produit_id->fetchAll();
if(isset($_POST['update'])){
    $pid = $_POST['pid'];
    $id_pro = $_POST['id_produit'];
   $id_pro = filter_var($id_pro, FILTER_SANITIZE_STRING);
   $date_debut = $_POST['date_debut'];
   $date_debut = filter_var($date_debut, FILTER_SANITIZE_STRING);
   
   $date_fin = $_POST['date_fin'];
   $date_fin = filter_var($date_fin, FILTER_SANITIZE_STRING);

   $nouveau_prix = $_POST['nouveau_prix'];
   $nouveau_prix = filter_var($nouveau_prix, FILTER_SANITIZE_STRING);

//    $update_product_pro = $pdo->prepare("UPDATE `promotion` SET produit_id = ?, date_debut = ?,date_fin= ?, nouveau_prix = ?
//    WHERE id = ?");
//    $update_product_pro->execute([$id_pro,$date_debut, $date_fin,$nouveau_prix,$pid]);

//    $message[] = 'product updated successfully!';
//    header('location:Promotion.php');


   $select_products_pro = $pdo->prepare("SELECT * FROM `promotion` WHERE produit_id = ?");
   $select_products_pro->execute([$id_pro]);

   if ($select_products_pro->rowCount() > 0) {
      $message[] = 'le produit  existe déjà dans la promotion!';
   } else {
    $update_product_pro = $pdo->prepare("UPDATE `promotion` SET produit_id = ?, date_debut = ?,date_fin= ?, nouveau_prix = ?
    WHERE id = ?");
    $update_product_pro->execute([$id_pro,$date_debut, $date_fin,$nouveau_prix,$pid]);
 
    $message[] = 'product updated successfully!';

      if ($update_product_pro) {
        $message[] = 'product updated successfully!';
        header('location:Promotion.php');
           }
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

   <h1 class="heading">Mettre à jour la promotion






</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $pdo->prepare("SELECT * FROM `promotion` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="../<?=$fetch_products['produit_img']; ?>">
     
      <div class="image-container">
         <div class="main-image">
            <img src="../<?= $fetch_products['produit_img']; ?>" alt="">
         </div>
         
      </div>
      <span>Update Nom</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['produit_nom']; ?>" readonly>
      <div class="inputBox">
            <span>Id Produit (required)</span>
            <select name="id_produit"  class="box">
                 <option disabled select>  <?= $fetch_products['produit_id'].' '.$fetch_products['produit_nom'] ?></option>
               <?php foreach($data_produit_id as $r) { ?>
             
                        <option value="<?= $r['id'] ?>">  <?= $r['id'].' '.$r['nom'] ?></option>
                    <?php } ?>
            </select>
        </div>
      <div class="inputBox">
            <span>date_debut(required)</span>
            <input type="date" name="date_debut"  class="box"value="<?= $fetch_products['date_debut']; ?>" required>
        </div>
        <div class="inputBox">
            <span>date_fin(required)</span>
            <input type="date" name="date_fin"  class="box" value="<?= $fetch_products['date_fin']; ?>" required>
        </div>
   
         <div class="inputBox">
            <span>nouveau prix (required)</span>
            <input type="number" name="nouveau_prix"  class="box" required value="<?= $fetch_products['nouveau_prix']; ?>"> 

         </div>


      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="Promotion.php" class="option-btn">Go Back.</a>
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