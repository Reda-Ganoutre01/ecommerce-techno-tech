
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="CSS/style.css">
    <title>Search</title>
    <link rel="stylesheet" href="CSS/aos.css" />


</head>
<body>

<?php
include('header.php');
?>

   <?php
if (isset($_POST['search_btn'])) {
    $search_box = $_POST['search_box'];

    echo '<div class="title_box" data-aos="fade-down">
            <span>
              <h6><a href="index.php">Accueil/</a></h6>
              <h2 id="boxtittle">Tous Les Résultats de la recherche pour:' . $search_box . '</h2>
            </span>
          </div>';

    $pdo = new pdo('mysql:host=localhost;dbname=ecom_db', 'root', '');
    $select_products = $pdo->prepare("SELECT * FROM produits WHERE nom LIKE :search_box OR Nom_categorie LIKE :search_box");
    $select_products->execute(array(':search_box' => '%' . $search_box . '%'));
    $data = $select_products->fetchAll();

    ?>

    
<section id="product1" class="section-p1">
    
<div class="pro-container" data-aos="zoom-in">

    <?php
       
        
       if ($select_products->rowCount() > 0) {
        foreach ($data as $val){
         

            echo '<div class="pro" >';
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
      
    } else {
        echo '<p class="empty">no products found!</p>';
    }
    } else {
    echo '<p class="empty">no products found!</p>';
    }
        ?>
 
    
</div>
</section>



<?php
include("footer.php");
    ?>   
    <script src="js/aos.js"></script>
    <script src="js/aos.js"></script>
  <script>
    AOS.init({
      offset:100,
      duration:1450,
    });
  </script>
</body>
</html>
