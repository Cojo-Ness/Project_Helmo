<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Éditer Mot de passe';
include("./inc/head.inc.php");
require "./php/userClass.php";
use User\UserManage;
$userRegister = new UserManage();
$userRegister->editPasswordUser();

/*ERRORS + ANTI URL MODIF*/
if (isset($_SESSION['loggedIn']) == true): ?>
<h1 style="margin-top:25px;">Éditer le profil<span class="vert">.</span></h1>
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
  <form method="post" enctype="multipart/form-data">
    <label for="password">Mot de passe actuel</label><input id="password" name="password" type="password" autofocus placeholder="*******"><br>
    <label for="newPassword">Nouveau mot de passe</label><input id="newPassword" name="newPassword" type="password" autofocus placeholder="*******"><br>
    <label for="verifNewPassword">Vérification du nouveau mot de passe</label><input id="verifNewPassword" name="verifNewPassword" type="password" autofocus placeholder="*******"><br>
    <input class="button-3" name="btnOK" type="submit" value="Modifier" name="editPasswordUser">
  </div>


<?php else: header('Location:./index.php');?>
  <?php endif; ?>
  <!--INCLUDE FOOTER-->
  <?php include("inc/footer.inc.php"); ?>
</body>
</html>
