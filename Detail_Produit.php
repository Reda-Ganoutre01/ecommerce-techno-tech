<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/detail.css">
    <link rel="stylesheet" href="CSS/style.css">


    <title>Product Details</title>
    <style>
         .favorite_icon {
            margin-left: 345px;
            transition: transform 0.3s ease-in-out;
        }

        .favorite_icon:hover {
            transform: scale(1.2); 
        }

        .favorite_icon i {
            font-size: 30px;
        }

        .favorite_icon:hover i {
            color: blue; 
        }
        .favorite_icon .btn_send{

            background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
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
                // Output favorite icon with onclick event to call addToFavorites function
                echo '<form action="add_to_favorites.php" method="POST">';
                echo '<input type="hidden" name="id_produit" value="' . $val["id"] . '">';
                echo '<input type="hidden" name="nom_produit" value="' . $val["nom"] . '">';
                echo '<input type="hidden" name="prix_produit" value="' . $val["prix"] . '">';
                echo '<input type="hidden" name="image" value="' . $val["img"] . '">';
                echo '<button class="favorite_icon btn_send" style="margin-left: 345px;background-color: transparent;
                border: none;
                cursor: pointer;
                padding: 0;"  name="send" type="submit">';
                echo '<i style="font-size: 30px;" class="fa fa-solid fa-heart head-card"></i>';
                echo '</button>';
                echo '</form>';
              
                // Output product price, review, quantity info, delivery info, and order button
                
                echo '<div class="Element_prix">';
                echo '<h2>Prix</h2>';
                 echo '<h3 id="totalPrice">'.$val['prix'].',00 MAD'.'</h3>';
                echo '</div>';
               
                echo '<div class="review">';
                echo '<div class="star" style="color:yellow">';
                for ($i=0;$i<$val['nbr_star'];$i++){
                    echo '<i class="fa fa-star rating-color"></i>';
                }
                echo '<i class="fa fa-star"></i>';
                echo '</div>';
                echo '<form action="add_to_cart.php" method="POST">';
                echo '<div class="quantity-info" style="margin-top: 20px;">
                      <label for="quantity" style="font-size: 18px; color: #333;">Quantity:</label>
                      <div class="quantity-input">
                          <button class="quantity-btn" onclick="event.preventDefault();decrementQuantity()"><i class="fas fa-minus"></i></button>
                          <input type="number" id="quantity" name="quantity" value="1" min="1" style="font-size: 16px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 5px; width: 60px; text-align: center;">
                          <button class="quantity-btn" onclick="event.preventDefault();incrementQuantity()"><i class="fas fa-plus"></i></button>
                      </div>
                  </div>';
                echo '<div class="delivery-info">';
                // Example delivery information
                echo '<p>Livraison gratuite en 2 jours ouvrables.</p>';
                echo '</div>';
                echo '</div>';
                // echo '<a href="#" class="command-btn">Commander</a>';
               
                echo '<input type="hidden" name="id_produit" value="' . $val["id"] . '">';
                echo '<input type="hidden" name="nom_produit" value="' . $val["nom"] . '">';
                echo '<input type="hidden" name="prix_produit" value="' . $val["prix"] . '">';
                echo '<input type="hidden" name="image" value="' . $val["img"] . '">';
                echo '<button class="command-btn add-to-cart-btn">Ajouter Au Panier</button>';
                echo '</form>';
                ?>
            </div>
        </div>
</div>
        <section id="product1" class="section-p1">
            <h2 class="title">Produits Similaires </h2>
           
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
                    foreach ($data as $val) {
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
                        echo '<a class="cart" href="Detail_Produit.php?id1=' . $val["id"] . '">Voir détails</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucun produit trouvé pour cette catégorie.</p>';
                }
                ?>
             
            </div>
        </section>
    
    <script>
     

    function incrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
       
    }

    function decrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            
        }
    }

    
   
    </script>
</body>
</html>
<?php
         include("footer.php");

                ?>