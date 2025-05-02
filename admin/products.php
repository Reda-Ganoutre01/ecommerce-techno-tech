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
if (isset($_POST['add_product'])) {
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $categorie = $_POST['categorie'];
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

   $select_products = $pdo->prepare("SELECT * FROM `produits` WHERE nom = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'le nom du produit existe déjà !';
   } else {
      $insert_products = $pdo->prepare("INSERT INTO `produits` (nom, prix, description, nbr_star, top, Nom_categorie, img, quantite_en_stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_products->execute([$name, $price, $details, $nbr_star, $top, $categorie, $image_folder_01, $quantite_en_stock]);

      if ($insert_products) {
         $message[] = 'nouveau produit ajouté !';
      }
   }
}
if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $pdo->prepare("DELETE FROM `produits` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   // unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   // unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   // unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   // $delete_product = $pdo->prepare("DELETE FROM `products` WHERE id = ?");
   // $delete_product->execute([$delete_id]);
   // $delete_cart = $pdo->prepare("DELETE FROM `cart` WHERE pid = ?");
   // $delete_cart->execute([$delete_id]);
   // $delete_wishlist = $pdo->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   // $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
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

   <h1 class="heading">Ajouter un produit</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Product Name (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
         </div>
         <div class="inputBox">
            <span>Product Price (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        <div class="inputBox">
            <span>Image (required)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>Categorie (required)</span>
            <select name="categorie"  class="box">
              
               <?php foreach($data as $r) { ?>
                        <option value="<?= $r['nom_Categorie'] ?>">  <?= $r['nom_Categorie'] ?></option>
                    <?php } ?>
            </select>
        </div>
         <div class="inputBox">
            <span>top(required)</span>
            <input type="number" name="top"  class="box" required>
        </div>
        <div class="inputBox">
            <span>Nbr de Star(required)</span>
            <input type="number" name="nbr_star"  class="box" required>
        </div>
        <div class="inputBox">
            <span>quantite_en_stock(required)</span>
            <input type="number" name="quantite_en_stock"  class="box" required>
        </div>
   
         <div class="inputBox">
            <span>Product description (required)</span>
            <textarea name="details" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="add product" class="btn" name="add_product">
   </form>

</section>

<section class="show-products">
   <h1 class="heading">Produits ajoutés.





.</h1>
   <div class="box-container">
   <?php
      $select_products = $pdo->prepare("SELECT * FROM `produits`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../<?= htmlspecialchars($fetch_products['img']); ?>" alt="">
      <div class="name"><?= htmlspecialchars($fetch_products['nom']); ?></div>
      <div class="price">prix:<span><?= htmlspecialchars($fetch_products['prix']); ?></span>DH</div>
      <!-- <div class="details"><span><?= htmlspecialchars($fetch_products['']); ?></span></div> -->
      <div class="flex-btn">
         <a href="update_product.php?update=<?= htmlspecialchars($fetch_products['id']); ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?= htmlspecialchars($fetch_products['id']); ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
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