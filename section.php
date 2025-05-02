<?php
$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");
$prod = $pdo->prepare('SELECT * FROM promotion ORDER BY id DESC');
$prod->execute();
$data_pro = $prod->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 

   <link rel="stylesheet" href="CSS/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style_sect.css">
     <!-- style animation -->
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>
<body>
   

<div class="home-bg">
    <section class="home">
        <div class="swiper home-slider" data-aos="fade-up">
            <div class="swiper-wrapper" >
            <?php
                foreach($data_pro as $row) {
                    echo '<div class="swiper-slide slide">
                            <div class="image">
                                <img src=".//' . $row['produit_img'] . '" alt="">
                            </div>
                            <div class="content">
                                <span>Remise de '. $row['pourcentage_reduction'] . '% Off</span>
                                <h4>' . $row['produit_nom'] . '</h4>
                                <a class="btn" href="Detail_Produit.php?id1=' . $row["produit_id"] . '">Shop Now</a>
                            </div>
                        </div>';
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
</div> 

<script src="js/swiper-bundle.min.js"></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      offset:300,
      duration:1450,
    });
  </script>
<script>
var swiper = new Swiper(".home-slider", {
   loop: true,
   spaceBetween: 20,
   autoplay:{delay:1500},
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
});
</script>

</body>
</html>