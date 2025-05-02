<footer class="footer">

   <section class="grid">

      <div class="box">
      <h3>Liens rapides</h3>
<a href="index.php"> <i class="fas fa-angle-right"></i> Home</a>
         <a href="products.php"> <i class="fas fa-angle-right"></i> Product</a>
         <?php  
                    if(isset($_SESSION['id_client'])) {
                        echo '<a href="orders.php"> <i class="fas fa-angle-right"></i> Command</a>';
                    }
                    
                    ?>
           
         <a href="contact.php"> <i class="fas fa-angle-right"></i> Contact</a>
      </div>

      <div class="box">
      <h3>Liens supplémentaires</h3>
<a href="login.php"> <i class="fas fa-angle-right"></i> Login</a>
        
         <a href="Register.php"> <i class="fas fa-angle-right"></i> Register</a>
         <a href="cart_page.php"> <i class="fas fa-angle-right"></i> Cart</a>
         <a href="Favorite_page.php"> <i class="fas fa-angle-right"></i> Favorite</a>
      </div>

      <div class="box">
         <h3>Contactez-nous.</h3>
         <a href="tel:9800000000"><i class="fas fa-phone"></i> +212 70 000 0000</a>
         <a href="tel:9900000000"><i class="fas fa-phone"></i> +212 64 110 0000</a>
         <a href="mailto:harshchy143@gmail.com"><i class="fas fa-envelope"></i> TecnoTech@gmail.com</a>
         <a href="https://www.google.com/myplace"><i class="fas fa-map-marker-alt"></i> Rabat, </a>
      </div>

      <div class="box">
      <h3>Suivez-nous</h3>
<a href="https://www.facebook.com/TechnoTech1" target="_blank"><i class="fab fa-facebook-f"></i>facebook</a>
         <a href="https://twitter.com/TechnoTech1" target="_blank"><i class="fab fa-twitter"></i>Twitter</a>
         <a href="https://www.instagram.com/TechnoTech1__/" target="_blank"><i class="fab fa-instagram"></i>Instagram</a>
         <a href="https://www.linkedin.com/in/TechnoTech1/" target="_blank"><i class="fab fa-linkedin"></i>Linkedin</a>
      </div>

   </section>

   <div class="credit">&copy; copyright  <?= date('Y'); ?> by <span>Reda Ganoutre et Adnane Benmalk</span> | tous droits réservés!</div>

</footer>