<?php
$pdo=mysqli_connect('localhost','root','','ecom_db');
$s=mysqli_query($pdo,"select * from categories");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Techno Tech</title>
    <!-- font-awesome cdn -->
    <!-- <link rel="stylesheet" href="bootstrap/bootstrap.css"> -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!-- favicon -->
    <link rel="icon" href="img/logo/logo rev.png" />
    <!-- css style -->
    <link rel="stylesheet" href="./CSS/style.css" />
    <style>
      #navbar li  a.active{
  color:blue;
}
    </style>
  </head>

  <body>
    <!-- Header -->
    <header id="Header">
        <a href="index.php"><img src="./img/logo/logo rev.png"
            class="logo"
            alt=""></a>
            <form class="Search" action="Search_prod.php" method="POST">
                <input type="text" placeholder="Rechercher..." name="search_box">
                <button type="submit" name="search_btn"><img src="images/icons-header/search.png"></button>
          
                
              </form>
            <nav>
                <ul id="navbar">
                    <li id="links_add"><a href="index.php">Home</a></li>
                    <li><a href="Search_prod.php" id="links_add" >Products</a></li>
                    <li>
            <a href="#">Categories ▾</a>
            <ul class="dropdown">
            <?php
while($r=mysqli_fetch_array($s))
{
   ?> 


<li>
                            <?php
                            echo '<a id="links_add" class="text-light text-decoration-none" href="Detail_Produit.php?id1=' . $r["id_Categorie"] . '">'.$r['nom_Categorie']
                            .'</a>'
                            ?>
                           </a>                          
                        </li> 

<?php

}

?>
            </ul>
        </li>
                    
                    <li  ><a href="Contact.php" id="links_add">Contact</a></li>
                    <li class="lg_bag" ><a href="#" id="links_add"><i class="fa-solid fa-bag-shopping head-card"></i></a></li>
                    <li class="lg_bag" ><a href="#" id="links_add"><i class="fa fa-solid fa-heart head-card"></i></a></li>
                    <li class="lg_bag" ><a href="#" id="links_add"><i class="fa fa-solid fa-user head-card" ></i></a></li>
                    <a href="#" id="close"><i class="fa fa-solid fa-xmark head-card"></i></a>
                </ul>
            </nav>
            <div id="mobile">
            <a href="#">
                <i class="fa-solid fa-bag-shopping">

                </i></a>
                <i id="bar" class="fa-solid fa-bars"></i>

            </div>
    </header>

    <!-- Hero Section -->

    <!-- Feature Section -->

    <!-- Products -->

    <!-- Call to Action -->

    <!--Small Banner  -->

    <!-- Feauture Banner -->

    <!-- NewsLetter -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var links = document.querySelectorAll('#links_add');

        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                links.forEach(function(link) {
                    link.classList.remove('active');
                });

                this.classList.toggle('active');
            });
        });
    });
</script>
</html>
