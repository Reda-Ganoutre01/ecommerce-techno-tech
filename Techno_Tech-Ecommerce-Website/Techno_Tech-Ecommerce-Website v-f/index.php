<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Techno Tech</title>
        <link rel="icon" href="img/logo/logo rev.png" />

    <link rel="stylesheet" href="CSS/style.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      />
      <!-- style animation -->
      <link rel="stylesheet" href="CSS/aos.css" />
  </head>

  <body>  
    <?php 
    include("header.php");
      include('section.php');

    ?>








 <section id="product1" class="section-p1" >
    <h2 class="title"  data-aos="fade-up">LES PLUS VENDUS</h2>
    <a href="Plus_Produit.php?categorie=LES PLUS VENDUS" class='plus' data-aos="fade-up">
      Plus >
    </a>
<div class="pro-container" data-aos="zoom-in">

    <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where top='10' GROUP BY id DESC LIMIT 5" );
        $produit->execute();
        $data=$produit->fetchAll();
        
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


<section id="product1" class="section-p1">
    <h2 class="title2" >Ecran Gamer</h2>
    <a href="Plus_Produit.php?categorie=Ecran Gamer" class='plus' >
      Plus >
    </a>
<div class="pro-container" >

    <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'Ecran Gamer' GROUP BY id DESC LIMIT 5" );
        $produit->execute();
        $data=$produit->fetchAll();
        
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

<section id="product1" class="section-p1">
    <h2 class="title2" >PC PORTABLE</h2>
    <a href="Plus_Produit.php?categorie=PC PORTABLE" class='plus' >
      Plus >
    </a>
<div class="pro-container" >

    <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'PC PORTABLE' GROUP BY id DESC LIMIT 5" );
        $produit->execute();
        $data=$produit->fetchAll();
        
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



<section class="section_card3" data-aos="fade-down">
  <div class="elements">
    <div class="z1">
            <img src="images/img-Seaction/FULL-PACK-QWERTY-3.png" alt="">

    </div>
    <div class="z2" data-aos="zoom-in">
      <h2>Accessoires</h2>
      <button>
        <span>
           <img  src="images/img-Seaction/keyboard.png" alt="">  
        <a href="Plus_Produit.php?categorie=CLAVIER">
      Clavier</a> </span>
             

     </button>
      <button>
        <span>
          <img  src="images/img-Seaction/wirelss-mouse-icon.png" alt="">  

      <a href="Plus_Produit.php?categorie=SOURIS">
      Souris</a>
        </span>
        </button>
      <button>
        <span>
           <img  src="images/img-Seaction/headphone.png" alt="">  

      <a href="Plus_Produit.php?categorie=CASQUE">
      Casque</a>
        </span>
             </button>
    </div>
      


  </div>
</section>

<!-- Clavier -->
<div  data-aos="zoom-in">
  <section id="product1" class="section-p1" >
    <h2 class="title3"  >CLAVIER</h2>
    <a href="Plus_Produit.php?categorie=CLAVIER" class='plus' >
      Plus >
    </a>
<div class="pro-container" >

    <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'CLAVIER' GROUP BY id DESC LIMIT 5" );
        $produit->execute();
        $data=$produit->fetchAll();
        
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

<!-- Casque -->
<section id="product1" class="section-p1" >
    <h2 class="title3"  >CASQUE</h2>
    <a href="Plus_Produit.php?categorie=CASQUE" class='plus'>
      Plus >
    </a>
<div class="pro-container" >

    <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'CASQUE' GROUP BY id DESC LIMIT 5" );
        $produit->execute();
        $data=$produit->fetchAll();
        
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

<!-- Souris -->
<section id="product1" class="section-p1" >
    <h2 class="title3"  >SOURIS</h2>
    <a href="Plus_Produit.php?categorie=SOURIS" class='plus'>
      Plus >
    </a>
<div class="pro-container" >

    <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'Souris' GROUP BY id DESC LIMIT 5" );
        $produit->execute();
        $data=$produit->fetchAll();
        
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

</div>


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
