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
 }
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
                    <?php while($r=mysqli_fetch_array($s)) { ?>
                        <li>
                            <a class="text-light text-decoration-none" href="Plus_Produit.php?categorie=<?= $r["nom_Categorie"] ?>">
                                <?= $r['nom_Categorie'] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li><a href="Contact.php" class="links_add">Contact</a></li>
                        <li class="lg_bag"><a href="Favorite_page.php" class="links_add">
                            <i class="fa fa-solid fa-heart head-card"></i><span>(0)</span>
                        </a>
</li>

            <li class="lg_bag">
                <a href="card_page.php" class="links_add"><i class="fa-solid fa-bag-shopping head-card"></i><span>(0)</span></a></li>
            <li class="lg_bag"><a href="login.php" class="links_add"><i class="fa fa-solid fa-user head-card"></i></a></li>
            <a href="#" id="close"><i class="fa fa-solid fa-xmark head-card"></i></a>
        </ul>
    
    </nav>

    <div id="mobile">
        <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fa-solid fa-bars"></i>
    </div>
</header>
<script src="script/btn.js"></script>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var links = document.querySelectorAll('.links_add');

    links.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            links.forEach(function(link) {
                link.classList.remove('active');
            });

            this.classList.add('active');
        });
    });
});
</script> -->

</body>
</html>