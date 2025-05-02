<?php
$pdo = new PDO("mysql:host=localhost;dbname=ecom_db", "root", "");
   
?>
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
<header class="header">

   <section class="flex">
<a href="#">
   
</a>
      <a href="../admin/dashboard.php" class="logo">   
 Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="../admin/dashboard.php">Home</a>
         <a href="../admin/products.php">Products</a>
         <a href="../admin/Promotion.php">Promotions</a>
         <a href="../admin/categories.php">Categories</a>

         <a href="../admin/placed_orders.php">Command</a>
         <a href="../admin/admin_accounts.php">Admins</a>
         <a href="../admin/users_accounts.php">Utilisateur</a>
         <a href="../admin/messages.php">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $pdo->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">Modifier le profil</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">Inscrire</a>
            <a href="../admin/admin_login.php" class="option-btn">Connexion</a>
         </div>
         <a href="../admin/admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">Déconnexion</a> 
      </div>

   </section>

</header>