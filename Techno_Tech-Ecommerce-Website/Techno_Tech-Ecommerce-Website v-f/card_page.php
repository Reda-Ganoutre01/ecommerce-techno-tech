<?php 
    session_start(); // Start or resume the session
    $mess_client='';
$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");

    if (isset($_SESSION['email']) && isset($_SESSION['username'])){
        $mess_client='<h1>Hello, ' . htmlspecialchars($_SESSION['username']) . '!</h1><p>Welcome to the card page.</p>';
    } else {
        header("Location: login.php");
        exit();
    }


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


function calculateTotal($pdo) {
    $total = 0;
    foreach ($_SESSION['cart'] as $id => $quantity) {
        $stmt = $pdo->prepare("SELECT prix FROM produits WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        $total += $product['prix'] * $quantity;
    }
    return $total;
}


$discount = 0;
if (isset($_POST['promo_code'])) {

    $discount = calculateTotal($pdo) * 0.1;
}

if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $quantity;
        }
    }
}

   
    ?>   <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Techno Tech</title>
    <link rel="stylesheet" href="CSS/style_panier.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      

      />
    <link rel="icon" href="img/logo/logo rev.png" />
    <link rel="stylesheet" href="CSS/aos.css" />

  </head>

  <body>  
    <?php
          include("header.php");

    ?>
  <div class="container" data-aos="zoom-in">
    <h1>Shopping Cart</h1>
    <form action="cart.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
               
                <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                  
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
                    $stmt->execute([$id]);
                    $product = $stmt->fetch();
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['nom']); ?></td>
                        <td><?php echo htmlspecialchars($product['prix']); ?> MAD</td>
                        <td>
                            <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $quantity; ?>" min="0">
                        </td>
                        <td><?php echo htmlspecialchars($product['prix']) * $quantity; ?> MAD</td>
                    </tr>
                <?php endforeach; ?>
              
                <tr class="total-row">
                    <td colspan="3" align="right">Total:</td>
                    <td><?php echo calculateTotal($pdo) - $discount; ?> MAD</td>
                </tr>
            </tbody>
        </table>
       
        <div class="promo-code">
            <input type="text" name="promo_code" placeholder="Promo Code">
            <button type="submit" name="apply_promo">Apply Promo Code</button>
        </div>
      
        <div class="action-buttons">
            <button type="submit" name="update_cart">Update Cart</button>
            <button type="submit" name="checkout">Proceed to Checkout</button>
        </div>
    </form>
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
