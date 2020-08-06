<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Connexion';
include("./inc/head.inc.php");
require "./php/userClass.php";
use User\UserManage;
$userRegister = new UserManage();
$userRegister->loginUser();

/*ERRORS + ANTI URL MODIF*/
if (!isset($_SESSION['loggedIn'])): ?>
<h1>Connectez vous à votre compte<span class="vert">.</span></h1>
<?php if(isset($_SESSION["ERROR"])){
  echo "<div id='error'>
  <p style='color:#000000; text-align:center;'>Vous n'avez pas rempli le formulaire correctement</p>
  <ul>";
  foreach ($_SESSION["ERROR"] as $error){
    echo "<li>*" .$error."</li>";
  }
  echo "</ul>
  </div>";unset($_SESSION["ERROR"]);}?>

<!--HTML-->
<div id="conteneur-registration">
  <form method="post">
    <label for="login">Login</label><input id="login" name="login" type="text" placeholder="Votre login"><br>
    <label for="mot_passe">Mot de passe</label><input id="mot_passe" name="mot_passe" type="password" placeholder="*******"><br>
    <input class="button-3" name="btnOK" type="submit" value="Se connecter">
    <a class="button-3" href="registration.php">Pas encore inscrit ?</a>
  </form>
</div>

<?php else: header('Location:./index.php'); ?>
<?php endif; ?>

<!--INCLUDE FOOTER-->
<?php include("inc/footer.inc.php");?>

<!--FIN HTML-->
</body>
</html>
