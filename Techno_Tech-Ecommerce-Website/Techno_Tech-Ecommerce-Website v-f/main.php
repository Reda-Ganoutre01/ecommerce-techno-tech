<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style_main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css
    ">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
<main class="main">
    <h2 class="title">LES PLUS VENDUS</h2>
    
 
        <div class="small-container">
             <div class="row">
             <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where top='10' limit 4" );
        $produit->execute();
        $data=$produit->fetchAll();
        
        foreach ($data as $val){
         

            echo '<div class="col-4">

                    ';
            echo    '<img  src='.$val['img'].'>';
            echo '<h4>'.$val['nom'].'</h4>';
            echo '<h3>'.$val['Nom_categorie'].'</h3>';
            echo '<div class="ratings">';
            for ($i=0;$i<$val['nbr_star'];$i++){
                echo '<i class="fa fa-star rating-color"></i>';
            }
            echo '<i class="fa fa-star"></i>';
            echo '</div>';
        
            echo '<p >' . $val['prix'] . ',00 MAD' . '</p>';

            echo '
                    <a class="btn_row" href="Detail_Produit.php?id1=' . $val["id"] . '">Voir details</a>';
            echo '</div>';
        }
        ?>

          



    </div>
        </div>
       
</main>
<script>
var swiper = new Swiper(".home-slider", {
   loop: true,
   spaceBetween: 20,
   autoplay:{delay:3000},
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
});
</script>
</body>
</html>