<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}    $mess_client_2='';

    if (isset($_SESSION['email']) && isset($_SESSION['username'])){
        // Display a welcome message if session variables are set
        $mess_client_2='<h3>bienvenue, ' . htmlspecialchars($_SESSION['username']) . '!</h3>';
    } else {
        // Redirect to the login page if session variables are not set
        header("Location: login.php");
        exit();
    }
?>     

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techno Tech - Favorite Products</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="img/logo/logo rev.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">


        <style>
        /* Add your custom CSS styles here */
        .delete-btn {
            background-color: #ff4d4d; /* Red color */
            color: #fff; /* White text */
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #ff3333; /* Darker red color on hover */
        }
       .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;

        }

        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }

        .favorite-products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            justify-content: center;
        }

        .favorite-product {
            background-color: #fff;
            padding: 20px;
            margin-top:20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .favorite-product:hover {
            transform: translateY(-5px);
        }

        .favorite-product img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .favorite-product h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .favorite-product p {
            font-size: 16px;
            color: #555;
        }
       .btn .btn-danger{
        margin-left:20px;
       }
    </style>
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container">
    <div class="welcome-message">
        <?php echo $mess_client_2; ?>
    </div>
    
    <h1>Vos Produits Préférés</h1>

    <div class="favorite-products">
        <?php
        // Include database connection file
        include('includ/connection.php');
        if(isset($_SESSION['id_client'])){
            $client_id = $_SESSION['id_client'];
            $query = "SELECT * FROM favorite WHERE id_client = '$client_id'";
            $result = mysqli_query($conn, $query);
        }

        // Check if query was successful
        if ($result) {
            // Fetch all rows from the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Output HTML for each favorite product
                echo '<center>';
                echo '<div class="favorite-product">';
                echo '<img src="' . $row['image'] . '" alt="' . $row['nom_produit'] . '">';
                echo '<h3>' . $row['nom_produit'] . '</h3>';
                echo '<p>Prix: ' . $row['prix_produit'] . ' MAD</p>';
                echo '<div class="btn-group">';
                echo '<a  href="detail_produit.php?id1=' . $row["id_produit"] . '" class="btn btn-primary ">Voir Details</a>';
                // Add other product details as needed
                echo '<form action="delete_product.php" method="POST">';
                echo '<input type="hidden" name="id_produit" value="' . $row["id_produit"] . '">';
                echo '<button style="margin-left:2px" type="submit" class="btn btn-danger  ">Supprimer</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</center>';
            }
            // Free result set
            mysqli_free_result($result);
        } else {
            // Query failed
            echo 'Error retrieving favorite products: ' . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </div>
</div>


    <?php include("footer.php"); ?>
</body>
</html>
