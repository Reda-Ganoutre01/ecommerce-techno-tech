
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style_Main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container_main">
<h1 id="title">vLES PLUS VENDUS</h1>
        <button >
           1
         </button>
    </div>
        <?php
        $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
        $produit=$pdo->prepare("select * from produits where top='10' limit 4" );
        $produit->execute();
        $data=$produit->fetchAll();
        echo '<div class="row">';
        
        // foreach ($data as $val){
        //     echo '<div class="card">
        //             <div class="card-head">';
        //     echo    '<img style="width:160px;padding: 10px;" calss="mx-4" src='.$val['img'].'>';
        //     echo '</div>';

        //     echo '<div class="card-body">';
        //     echo '<h3>'.$val['nom'].'</h3>';
        //     echo '<h6>'.$val['Nom_categorie'].'</h6>';
        //     echo '<ul class="text-success"><li><h6>En stock</h6></li></ul>';
        //     echo '<div class="ratings">';
        //     for ($i=0;$i<$val['nbr_star'];$i++){
        //         echo '<i class="fa fa-star rating-color"></i>';
        //     }
        //     echo '</div>';
        
        //     echo '<h6 id="box_prix" class="text-primary">' . $val['prix'] . ',00 MAD' . '</h6>';
        //     echo '<button  class="btn2" name="details" type="submit">
        //             <a class="text-light text-decoration-none" href="Detail_Produit.php?id1=' . $val["id"] . '">Voir details</a>
        //         </button>';
        //     echo '</div>';
        //     echo '</div>';
        // }
        echo '</div>';
        ?>
    </div>

</body>
</html>

    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,500;1,100;1,300&display=swap" rel="stylesheet"> -->
