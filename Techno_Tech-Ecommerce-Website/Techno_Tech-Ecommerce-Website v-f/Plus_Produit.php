<?php

if(isset($_GET['categorie'])){
  if ($_GET['categorie']!='LES PLUS VENDUS'){
    $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
  $select_products = $pdo->prepare("SELECT * FROM produits WHERE Nom_categorie LIKE :cat");
  $select_products->bindParam(':cat', $_GET['categorie'], PDO::PARAM_STR);
  $select_products->execute();
  $data = $select_products->fetchAll();
  }
  else{
    $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
    $produit=$pdo->prepare("select * from produits where top='10' GROUP BY id DESC LIMIT 5" );
    $produit->execute();
    $data=$produit->fetchAll();
  }
  

}

?>
<!DOCTYPE html>
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
    <!-- style animation -->
    <link rel="stylesheet" href="CSS/aos.css" />
  </head>
<body>
<?php include("header.php");?>
<section id="product1" class="section-p1" >
    <h2   data-aos="fade-up"><?php echo $_GET['categorie']; ?></h2>
   
<div class="pro-container" data-aos="zoom-in">

    <?php
        
        foreach ($data as $val){
         

            echo '<div class="pro">';
            echo    '<img  src='.$val['img'].'>';
            echo '        <div class="des">';
            echo '<span>'.$val['Nom_categorie'].'</span>';
            echo '<h5>'.$val['nom'].'</h5>';
            echo '<div class="star">';
            for ($i=0;$i<$val['nbr_star'];$i++){
                echo '<i class="fa fa-star rating-color"></i>';
            }
            echo '<i class="fa fa-star"></i>';
            echo '</div>';
        
            echo '<h4>' . $val['prix'] . ',00 MAD' . '</h4>';
            echo ' </div>';

            echo '
                    <a class="cart" href="Detail_Produit.php?id1=' . $val["id"] . '">Voir details</a>';
            echo '</div>';
        }
        ?>
 
    
</div>
</section>








<?php
include("footer.php");
    ?>   
    <script src="js/aos.js"></script>
  <script>
    AOS.init({
      offset:100,
      duration:1450,
    });
  </script>
</body>
</html>