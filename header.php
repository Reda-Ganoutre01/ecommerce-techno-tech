<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
   echo '
   <script>
      setTimeout(function(){
         document.querySelectorAll(".message").forEach(function(element){
            element.remove();
         });
      }, 3000); // 5000 milliseconds = 5 seconds
   </script>
   ';
}
?>


<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecom_db";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

?>

<?php

 $conn = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");

$pdo=mysqli_connect('localhost','root','','ecom_db');
$s=mysqli_query($pdo,"select * from categories");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Techno Tech</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
<link rel="icon" href="img/logo/logo rev.png">
<link rel="stylesheet" href="./CSS/style.css">

<style>

</style>
</head>
<body>
<header id="Header">
    <a href="index.php"><img src="./img/logo/logo rev.png" class="logo" alt=""></a>
    <form class="Search" action="Search_prod.php" method="POST">
        <input type="text" placeholder="Rechercher..." name="search_box">
        <button type="submit" name="search_btn"><img src="images/icons-header/search.png"></button>
    </form>
    <nav>
        <ul id="navbar">
            <li><a href="index.php" class="links_add">Home</a></li>
            <li><a href="products.php" class="links_add">Products</a></li>
            <li>
                <a href="#">Categories ▾</a>
                <ul class="dropdown">
                    <?php 
                        // Assuming $s is your database query result
                        while($r=mysqli_fetch_array($s)) { 
                    ?>
                        <li>
                            <a class="text-light text-decoration-none" href="Plus_Produit.php?categorie=<?= $r["nom_Categorie"] ?>">
                                <?= $r['nom_Categorie'] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <?php  
                    if(isset($_SESSION['id_client'])) {
                        echo ' <li><a href="orders.php" class="links_add">Command</a></li>';
                    }
                    
                    ?>
           

            <li><a href="Contact.php" class="links_add">Contact</a></li>
            <li class="lg_bag">
                <a href="Favorite_page.php" class="links_add">
                    <i class="fa fa-solid fa-heart head-card"></i>
                    <?php  
                    if(isset($_SESSION['id_client'])) {
                    
                            // Establishing a PDO connection
                            $pdo = new PDO('mysql:host=localhost;dbname=ecom_db', 'root', '');
                            // Set PDO to throw exceptions on error
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $client_id = $_SESSION['id_client'];
                            
                            // Prepare the query
                            $produit = $pdo->prepare("SELECT COUNT(*) AS article_count FROM favorite WHERE id_client = :client_id");
                            // Bind parameters
                            $produit->bindParam(':client_id', $client_id, PDO::PARAM_INT);
                            // Execute the query
                            $produit->execute();
                            // Fetch the result
                            $counter = $produit->fetch(PDO::FETCH_ASSOC);
                            
                            // Check if the query returned any result
                            if($counter !== false) {
                                echo "<span id='counter'>" . $counter['article_count'] . "</span>";
                            } else {
                                echo "<span id='counter'>0</span>";
                            }
                        
                    }
                    else {
                        echo "<span id='counter'>0</span>";
                    }
                ?>

                </a>
            </li>
            <li class="lg_bag"><a href="cart_page.php" class="links_add"><i class="fa-solid fa-bag-shopping head-card"></i><?php  
                    if(isset($_SESSION['id_client'])) {
                    
                            // Establishing a PDO connection
                            $pdo = new PDO('mysql:host=localhost;dbname=ecom_db', 'root', '');
                            // Set PDO to throw exceptions on error
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $client_id = $_SESSION['id_client'];
                            
                            // Prepare the query
                            $produit = $pdo->prepare("SELECT COUNT(*) AS article_count FROM cart WHERE id_client = :client_id");
                            // Bind parameters
                            $produit->bindParam(':client_id', $client_id, PDO::PARAM_INT);
                            // Execute the query
                            $produit->execute();
                            // Fetch the result
                            $counter = $produit->fetch(PDO::FETCH_ASSOC);
                            
                            // Check if the query returned any result
                            if($counter !== false) {
                                echo "<span id='counter'>" . $counter['article_count'] . "</span>";
                            } else {
                                echo "<span id='counter'>0</span>";
                            }
                        
                    }
                    else {
                        echo "<span id='counter'>0</span>";
                    }
                ?></a></li>
            <li class="lg_bag"><a href="login.php" class="links_add"><i class="fa fa-solid fa-user head-card"></i></a></li>
            <a href="#" id="close"><i class="fa fa-solid fa-xmark head-card"></i></a>
        </ul>
    </nav>
    <div id="mobile">
        <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fa-solid fa-bars"></i>
    </div>
</header>




</body>
</html>
