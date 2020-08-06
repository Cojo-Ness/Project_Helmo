<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Admin';
include("./inc/head.inc.php");
require "./php/adminClass.php";
use Admin\AdminManager;
$addcat = new AdminManager();
$addcat->addCategory();


/*ERRORS + ANTI URL MODIF*/
if (isset($_SESSION['loggedIn']) && isset($_SESSION['est_admin'])): ?>
<h1 style="margin-top:25px;">Ajouter catégorie<span class="vert">.</span></h1>
<?php if(isset($_SESSION["ERROR"])){
  echo "<div id='error'>
  <p style='color:#000000; text-align:center;'>Vous n'avez pas rempli le formulaire correctement</p>
  <ul>";
  foreach ($_SESSION["ERROR"] as $error){
    echo "<li>*" .$error."</li>";
  }
  echo "</ul>
  </div>";unset($_SESSION["ERROR"]);}?>

  <div id="conteneur-registration">
    <form method="post">
      <label for="addCat">Catégorie à ajouter</label><input id="addCat" name="addCat" type="text" placeholder="Nom de catégorie"><br>
      <input class="button-3" name="btnOK" type="submit" value="Ajouter" >
    </form>
  </div>



<?php else: header('Location:./index.php');?>
  <?php endif; ?>
  <!--INCLUDE FOOTER-->
  <?php include("inc/footer.inc.php"); ?>
</body>
</html>
