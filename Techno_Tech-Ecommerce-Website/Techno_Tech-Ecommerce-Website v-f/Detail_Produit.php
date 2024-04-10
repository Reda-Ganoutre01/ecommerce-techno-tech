<?php
include('header.php');
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .product-details {
            display: flex;
            justify-content: space-between;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        .product-info {
            flex: 1;
            padding: 20px;
        }

        .product-info h1 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .product-info img {
            width: 100%;
            max-width: 400px;
            height: auto;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .product-info h6 {
            color: #666;
        }

        .product-info .description {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .product-info .description h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .product-info .description p {
            color: #666;
        }

        .pricing-info {
            flex: 0 0 400px;
            padding: 20px;
            background-color: #f9f9f9;
            border-left: 1px solid #ddd;
            border-radius: 10px;
        }

        .pricing-info h2 {
            margin-top: 0;
            color: #333;
        }

        .pricing-info h3 {
            color: #28a745;
            font-size: 28px;
            margin-top: 0;
        }

        .review {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .delivery-info {
            margin-top: 20px;
        }

        .delivery-info p {
            color: #666;
        }

        .command-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            width: 100%;
            text-align: center;
            text-decoration: none;
        }

        .command-btn:hover {
            background-color: #0056b3;
        }

        .add-to-cart-btn {
            background-color: #28a745;
            margin-top: 10px;
        }

        .add-to-cart-btn:hover {
            background-color: #218838;
        }

        .similar-products {
            margin-top: 50px;
        }

        .similar-products h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .similar-products .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .similar-products .product {
            flex: 0 0 calc(20% - 20px);
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .similar-products .product img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px 0 0 5px;
        }

        .similar-products .product .details {
            padding: 20px;
        }

        .similar-products .product .details h3 {
            margin-top: 0;
            color: #333;
        }

        .similar-products .product .details .price {
            color: #28a745;
            font-size: 20px;
            margin-top: 5px;
        }

        .similar-products .product .details .delivery-info {
            margin-top: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-details">
            <div class="product-info">
                <?php
                $pdo=new pdo('mysql:host=localhost;dbname=ecom_db','root','');
                $id1 = isset($_GET['id1']) ? intval($_GET['id1']) : 0;
                $produit = $pdo->prepare("SELECT * FROM produits WHERE id = :id1");
                $produit->bindParam(':id1', $id1, PDO::PARAM_INT);
                $produit->execute();
                $data = $produit->fetchAll();
                
                foreach ($data as $val){
                    echo '<h1>'.$val['nom'].'</h1>';
                    echo '<img src="'.$val['img'].'" alt="'.$val['nom'].'">';
                  
                    echo '<div class="description">';
                    echo '<h2>Description</h2>';
                    echo '<p>'.$val['description'].'</p>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="pricing-info">
                <?php
                echo '<h2>Prix</h2>';
                echo '<h3>'.$val['prix'].',00 MAD'.'</h3>';
                echo '<div class="review">';
                echo '<div class="star">';
                for ($i=0;$i<$val['nbr_star'];$i++){
                echo '<i class="fa fa-star rating-color"></i>';
                }
                 echo '<i class="fa fa-star"></i>';
                 echo '</div>';
                echo '<div class="delivery-info">';
                
                // Example delivery information
                echo '<p>Livraison gratuite en 2 jours ouvrables.</p>';
                echo '</div>';
                
                echo '</div>';
                echo '<a href="#" class="command-btn">Commander</a>';
                echo '<a href="#" class="command-btn add-to-cart-btn">Ajouter au panier</a>'; // Added button
                ?>
            </div>
        </div>

        <section id="product1" class="section-p1">
    <h2 class="title">Produits Similaire </h2>
    <a href="#" class='plus'>
      Plus >
    </a>
<div class="pro-container">

    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=ecom_db', 'root', '');

    // Define $id1 if it's not already defined
    $id1 = isset($_GET['id1']) ? intval($_GET['id1']) : 0;
    
    // Retrieve the category name for the given id
    $categorie = $pdo->prepare("SELECT Nom_categorie FROM produits WHERE id = :id1");
    $categorie->bindParam(':id1', $id1, PDO::PARAM_INT);
    $categorie->execute();
    $result = $categorie->fetch(PDO::FETCH_ASSOC);
    $v = $result['Nom_categorie'];
    
    // Retrieve products for the specified category
    $produit = $pdo->prepare("SELECT * FROM produits WHERE Nom_categorie=:v LIMIT 4");
    $produit->bindParam(':v', $v, PDO::PARAM_STR);
    $produit->execute();
    $data = $produit->fetchAll();
    
    if (!empty($data)) {
        
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
    } else {
        echo '<p>No products found for the category.</p>';
    }
        ?>
 
    
</div>
</section>
    </div>
</body>
</html>
