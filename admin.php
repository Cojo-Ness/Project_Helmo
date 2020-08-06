<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Admin';
include("./inc/head.inc.php");
require "./php/adminClass.php";
use Admin\AdminManager;
$addcat = new AdminManager();
$addcat->addCategory();
$editcat = new AdminManager();
$editcat->editCategory();
$erasecat = new AdminManager();
$erasecat->eraseCategory();

/*ERRORS + ANTI URL MODIF*/
if (isset($_SESSION['loggedIn']) && isset($_SESSION['est_admin'])): ?>
<?php if(isset($_SESSION["ERROR"])){
  echo "<div id='error'>
  <p style='color:#000000; text-align:center;'>Vous n'avez pas rempli le formulaire correctement</p>
  <ul>";
  foreach ($_SESSION["ERROR"] as $error){
    echo "<li>*" .$error."</li>";
  }
  echo "</ul>
  </div>";unset($_SESSION["ERROR"]);}?>

  <h1 style="margin-top:25px;">Page admin<span class="vert">.</span></h1>
  <div id="conteneur-registration">
    <h1 style="margin-top:20px;">Partie catégorie<span class="vert">.</span></h1>
    <form>
      <label for="actucat">Catégories actuelles</label><br>
      <select></select>
    <br>
    <a class="button-3" href="addcat.php">Ajouter une catégorie</a>
    <br><br>
    <a class="button-3" href="editcat.php">Modifier une catégorie</a>
    <br><br>
    <a class="button-3" href="erasecat.php">Supprimer une catégorie</a>
    <br><br>
    <hr>
  </form>
  <h1>Partie projets<span class="vert">.</span>
  </div>


<?php else: header('Location:./index.php');?>
  <?php endif; ?>
  <!--INCLUDE FOOTER-->
  <?php include("inc/footer.inc.php"); ?>
</body>
</html>
