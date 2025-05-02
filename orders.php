<?php 
    include("header.php");

    ?>
<?php
$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");


if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

if(isset($_SESSION['id_client'])){
   $user_id = $_SESSION['id_client'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="Css/style.css">

</head>
<body>
   

<section class="orders">

   <h1 class="heading">Commandes passées.</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Veuillez vous connecter pour voir vos commandes.</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `commande` WHERE id_client = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
   <p>Placé le : <span><?= $fetch_orders['placed_on']; ?></span></p>
<p>Nom : <span><?= $fetch_orders['nom']; ?></span></p>
<p>Email : <span><?= $fetch_orders['email']; ?></span></p>
<p>Numéro de téléphone : <span><?= $fetch_orders['number']; ?></span></p>
<p>Adresse : <span><?= $fetch_orders['address']; ?></span></p>
<p>Méthode de paiement : <span><?= $fetch_orders['method']; ?></span></p>
<p>Vos commandes : <span><?= $fetch_orders['total_products']; ?></span></p>
<p>Prix total : <span><?= $fetch_orders['total_price']; ?> DH</span></p>
<p>Statut du paiement : <span style="color:<?php if($fetch_orders['payment_status'] == 'En cours')
 { echo 'red'; } else { echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span></p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">Pas encore de commandes passées !</p>';
      }
      }
   ?>

   </div>

</section>














<script src="js/script.js"></script>

</body>
</html>
<?php
include("footer.php");
    ?>  