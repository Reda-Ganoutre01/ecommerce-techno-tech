<?php include("header.php"); ?>
<?php
// confirmation_page.php

// Check if the form was submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve the value of totalprice from the form submission
//     $totalPrice = $_POST['totalprice'];
//     $totalProduit = $_POST['totalProduit'];
//     // Now you can use $totalPrice as needed
    
// } else {
//     // Handle the case when the form is not submitted
//     echo "Form was not submitted.";
// }


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['id_client'])){
   $user_id = $_SESSION['id_client'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE id_client  = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `commande`(id_client , nom, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id_client  = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'order placed successfully!';
      header("Location: orders.php");

   }else{
      $message[] = 'your cart is empty';
   }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Order Form</title>

</head>
<body>

<section class="checkout-orders">

<form action="" method="POST">

<h3>Vos Commandes</h3>

   <div class="display-orders">
   <?php
      $grand_total = 0;
      $cart_items[] = '';
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE id_client = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            $cart_items[] = $fetch_cart['nom_produit'].' ('.$fetch_cart['prix_produit'].' x '. $fetch_cart['quantity'].') - ';
            $total_products = implode($cart_items);
            $grand_total += ($fetch_cart['prix_produit'] * $fetch_cart['quantity']);
   ?>
      <p> <?= $fetch_cart['nom_produit']; ?> <span>(<?= $fetch_cart['prix_produit'].' DH'.'/- x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
         }
      }else{
         echo '<p class="empty">your cart is empty!</p>';
      }
   ?>
      <input type="hidden" name="total_products" value="<?= $total_products; ?>">
      <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
      <div class="grand-total">Total Général : : <span><?= $grand_total; ?> DH</span></div>
   </div>

   <h3>Passez votre commande</h3>

   <div class="flex">
   <div class="inputBox">
    <span>Nom :</span>
    <input type="text" name="name" placeholder="entrez votre nom" class="box" maxlength="20" required>
</div>
<div class="inputBox">
    <span>Votre Numéro :</span>
    <input type="number" name="number" placeholder="entrez votre numéro" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
</div>
<div class="inputBox">
    <span>Votre Email :</span>
    <input type="email" name="email" placeholder="entrez votre email" class="box" maxlength="50" required>
</div>

      <div class="inputBox">
    <span>Mode de Paiement :</span>
    <select name="method" class="box" required>
        <option value="Paiement à la Livraison">Paiement à la Livraison</option>
        <option value="CIH Bank">CIH Bank</option>
        <option value="paypal">PayPal</option>

    </select>
</div>
      <div class="inputBox">
         <span>Address line 01 :</span>
         <input type="text" name="flat"  class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>Address line 02 :</span>
         <input type="text" name="street" class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>Ville  :</span>
         <input type="text" name="city"  class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>Pays  :</span>
         <input type="text" name="country"  class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>ZIP CODE :</span>
         <input type="number" min="0" name="pin_code"  min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
      </div>
   </div>

   <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="Passer la commande">

</form>

</section>

   
</body>
</html>
    <?php include("footer.php"); ?>
