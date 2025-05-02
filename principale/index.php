<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Techno Tech</title>
        <link rel="icon" href="img/logo/logo rev.png" />
        <link rel="stylesheet" href="CSS/swiper-bundle.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/loader.css">

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

      <!-- style animation -->
      <link rel="stylesheet" href="CSS/aos.css" />
      <!-- <style>
 :root {
  --first-color: hsl(38, 92%, 58%);
  --first-color-light: hsl(38, 100%, 78%);
  --first-color-alt: hsl(32, 75%, 50%);
  --second-color: hsl(195, 75%, 52%);
  --dark-color: hsl(212, 40%, 12%);
  --white-color: hsl(212, 4%, 95%);
  --body-color: hsl(212, 42%, 15%);
  --container-color: hsl(212, 42%, 20%);

 
  --body-font: "Bai Jamjuree", sans-serif;
  --h2-font-size: 1.25rem;
  --normal-font-size: 1rem;
}

.swiper-button-prev:after,
.swiper-button-next:after {
  content: "";
}

.swiper-button-prev,
.swiper-button-next {
  width: initial;
  height: initial;
  font-size: 3rem;
  color: blue;
  display: none;
}

.swiper-button-prev {
  left: 0;
}

.swiper-button-next {
  right: 0;
}

.swiper-pagination-bullet {
  background-color: black;
  opacity: 1;
}

.swiper-pagination-bullet:active {
  background-color: blue;
}

@media screen and (min-width: 768px) {
  .pro-container {
    margin-inline: 3rem;
  }

  .swiper-button-next,
  .swiper-button-prev {
    display: block;
  }
}

/* For large devices */
@media screen and (min-width: 1120px) {
  .pro-container {
    max-width: 1420px;
  }

  .swiper-button-prev {
    left: -1rem;
  }

  .swiper-button-next {
    right: -1rem;
  }
}

      </style> -->
  </head>

  <body>  
    <?php 
    include("header.php");
      include('section.php');

    ?>

<div class="loader">

</div>



<div class="loader loader-hidden"></div>


 <section id="product1" class="section-p1" >
    <h2 class="title"  data-aos="fade-up">LES PLUS VENDUS</h2>
    <a href="Plus_Produit.php?categorie=LES PLUS VENDUS" class='plus' data-aos="fade-up" onclick="Clicker(event)">
      Plus >
    </a>
<div class="pro-container swiper" data-aos="zoom-in">
<div class="swiper-wrapper">
  <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where top='1' GROUP BY id DESC LIMIT 10" );
        $produit->execute();
        $data=$produit->fetchAll();
        
        foreach ($data as $val){
         

            echo '<div class="pro swiper-slide">';
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
<div class="swiper-button-next">
               <i class="ri-arrow-right"></i>
            </div>
            
            <div class="swiper-button-prev">
               <i class="ri-arrow-left--circle-fill"></i>
            </div>

            <!-- Pagination -->
            <!-- <div class="swiper-pagination"></div> -->

</div>

</section>


<section id="product1" class="section-p1">
    <h2 class="title2" >Ecran Gamer</h2>
    <a href="Plus_Produit.php?categorie=Ecran Gamer" class='plus' >
      Plus >
    </a>
<div class="pro-container swiper" data-aos="zoom-in">
<div class="swiper-wrapper">
  <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'Ecran Gamer' GROUP BY id DESC LIMIT 10" );        $produit->execute();
        $data=$produit->fetchAll();
        
        foreach ($data as $val){
         

            echo '<div class="pro swiper-slide">';
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
<div class="swiper-button-next">
               <i class="ri-arrow-right"></i>
            </div>
            
            <div class="swiper-button-prev">
               <i class="ri-arrow-left--circle-fill"></i>
            </div>

            <!-- Pagination -->
            <!-- <div class="swiper-pagination"></div> -->

</div>
</section>

<section id="product1" class="section-p1">
    <h2 class="title2" >PC PORTABLE</h2>
    <a href="Plus_Produit.php?categorie=PC PORTABLE" class='plus' >
      Plus >
    </a>
    <div class="pro-container swiper" data-aos="zoom-in">
<div class="swiper-wrapper">
  <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'PC PORTABLE' GROUP BY id DESC LIMIT 10" );
                $produit->execute();
        $data=$produit->fetchAll();
        
        foreach ($data as $val){
         

            echo '<div class="pro swiper-slide">';
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
<div class="swiper-button-next">
               <i class="ri-arrow-right"></i>
            </div>
            
            <div class="swiper-button-prev">
               <i class="ri-arrow-left--circle-fill"></i>
            </div>

            <!-- Pagination -->
            <!-- <div class="swiper-pagination"></div> -->

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
    <div class="pro-container swiper" data-aos="zoom-in">
<div class="swiper-wrapper">
  <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'CLAVIER' GROUP BY id DESC LIMIT 10" );        $produit->execute();
        $data=$produit->fetchAll();
        
        foreach ($data as $val){
         

            echo '<div class="pro swiper-slide">';
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
<div class="swiper-button-next">
               <i class="ri-arrow-right"></i>
            </div>
            
            <div class="swiper-button-prev">
               <i class="ri-arrow-left--circle-fill"></i>
            </div>

            <!-- Pagination -->
            <!-- <div class="swiper-pagination"></div> -->

</div>
</section>

<!-- Casque -->
<section id="product1" class="section-p1" >
    <h2 class="title3"  >CASQUE</h2>
    <a href="Plus_Produit.php?categorie=CASQUE" class='plus'>
      Plus >
    </a>
    <div class="pro-container swiper" data-aos="zoom-in">
<div class="swiper-wrapper">
  <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'CASQUE' GROUP BY id DESC LIMIT 10" );        $produit->execute();
        $data=$produit->fetchAll();
        
        foreach ($data as $val){
         

            echo '<div class="pro swiper-slide">';
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
<div class="swiper-button-next">
               <i class="ri-arrow-right"></i>
            </div>
            
            <div class="swiper-button-prev">
               <i class="ri-arrow-left--circle-fill"></i>
            </div>

            <!-- Pagination -->
            <!-- <div class="swiper-pagination"></div> -->

</div>
</section>

<!-- Souris -->
<section id="product1" class="section-p1" >
    <h2 class="title3"  >SOURIS</h2>
    <a href="Plus_Produit.php?categorie=SOURIS" class='plus'>
      Plus >
    </a>
    <div class="pro-container swiper" data-aos="zoom-in">
<div class="swiper-wrapper">
  <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where Nom_categorie LIKE 'Souris' GROUP BY id DESC LIMIT 10" );        $produit->execute();
        $data=$produit->fetchAll();
        
        foreach ($data as $val){
         

            echo '<div class="pro swiper-slide">';
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
<div class="swiper-button-next">
               <i class="ri-arrow-right"></i>
            </div>
            
            <div class="swiper-button-prev">
               <i class="ri-arrow-left--circle-fill"></i>
            </div>

            <!-- Pagination -->
            <!-- <div class="swiper-pagination"></div> -->

</div>
</section>

</div>


    <?php
include("footer.php");
    ?>   
<script src="js/swiper-bundle.min.js"></script>
<script src="js/articlesswiper.js"></script>
<script src="js/loader.js"></script>

<script src="js/aos.js"></script>
<script>
      AOS.init({
            offset: 100,
            duration: 1450,
            once: true, // Only animate once
            anchorPlacement: 'top-bottom', // Anchor placement
        });

        // Custom scroll direction logic
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // Scroll down
                document.querySelectorAll('.pro-container').forEach(element => {
                    if (element.getBoundingClientRect().top < window.innerHeight) {
                        element.style.opacity = 1;
                        element.classList.add('aos-animate');
                    }
                });
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For mobile or negative scrolling
        }, false);
    </script>
  </body>
</html>
