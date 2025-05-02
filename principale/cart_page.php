<?php
session_start(); // Start or resume the session
include('includ/connection.php');

// Redirect to login page if user is not logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch cart items from the database
$id_client = $_SESSION['id_client'];
$stmt = $conn->prepare("SELECT * FROM cart WHERE id_client = ?");
$stmt->bind_param("i", $id_client);
$stmt->execute();
$result = $stmt->get_result();

$totalProduit = $result->num_rows;
function calculateTotal($pdo) {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $stmt = $pdo->prepare("SELECT prix FROM produits WHERE id = ?");
        $stmt->execute([$item['id_produit']]);
        $product = $stmt->fetch();
        $total += $product['prix'] * $item['quantity'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .action-buttons {
            text-align: center;
        }

        .action-buttons button {
            padding: 10px 20px;
            margin: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #45a049;
        }

        .empty-cart {
            text-align: center;
            margin-top: 50px;
        }
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .delete-btn {
            background-color: #ff4444; /* Red color */
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #cc0000; /* Darker red color on hover */
        }
    </style>
</head>
<body>  
    <?php include("header.php"); ?>

    <div class="container" data-aos="zoom-in">
        <h1>Panier</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>image</th>
                        <th>Produit Nom</th>
                        <th>Prix</th>
                        <th>Quantite</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $totalPrice = 0; ?>
                        <?php $counter = 0; ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <?php if ($counter < 5): ?> <!-- Display only first 5 products -->
                                <tr>
                                    <td><img src="<?php echo $row['image']; ?>" alt="Product Image" class="product-image"></td>
                                    <td><?php echo $row['nom_produit']; ?></td>
                                    <td><?php echo $row['prix_produit']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['prix_produit'] * $row['quantity']; ?></td>
                                    <td><form method="post" action="delete_cart_produit.php">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="delete-btn" name="delete_product">
                                        Supprimer
                                    </button>
                                </form></td>

                                </tr>
                                <?php 
                                    $totalPrice += $row['prix_produit'] * $row['quantity']; 
                                    $counter++;
                                ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </tbody>
            </table>

            <div class="total">
            Total Prix: <span id="total-price" style="Color:#ff523b"><?php echo $totalPrice; ?> DH</span> 
            </div>

            <div class="action-buttons">
            <form action="confirmation_page.php" method="post">
            <input type="hidden" id="total-price" name="totalprice" value="<?php echo $totalPrice; ?>">
            <input type="hidden" id="totalProduit" name="totalProduit" value="<?php echo $totalProduit; ?>">
                   
            <button type="submit" name="checkout">Terminer l'achat</button>
            </form>
            </div>
        <?php else: ?>
            <p class="empty-cart">Votre panier est vide.</p>
        <?php endif; ?>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
