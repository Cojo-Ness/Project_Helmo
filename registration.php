<!--INCLUDE HEAD + VARIABLE SESSION + CLASS UserEdit-->
<?php
session_start();
$titre = 'Inscription';
include("inc/head.inc.php");
require "./php/userClass.php";
use User\UserManage;
$userRegister = new UserManage();
$userRegister->registerUser();

/*ERRORS + ANTI URL MODIF*/
if (isset($_SESSION['loggedIn']) == false):?>
<h1>Création de votre compte<span class="vert">.</span></h1>
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
  <form method="post" enctype="multipart/form-data">
    <label for="nom">Nom<span class="vert">*</span></label><input id="nom" name="nom" type="text" autofocus  placeholder="Votre nom"><br>
    <label for="prenom">Prénom<span class="vert">*</span></label><input id="prenom" name="prenom" type="text"  placeholder="Votre prénom"><br>
    <label for="courriel">Adresse email<span class="vert">*</span></label><input id="courriel" name="courriel" type="text"  placeholder="example@domain.com"><br>
    <label for="password">Mot de passe<span class="vert">*</span></label><input id="password" name="password" type="password"  placeholder="*******"><br>
    <label for="verifpassword">Vérification<span class="vert">*</span></label><input id="verifpassword" name="verifpassword" type="password" value=""  placeholder="*******"><br>
    <label for="login">Login<span class="vert">*</span></label><input id="login" name="login" type="text"  placeholder="Votre pseudo"><br>
    <label for="phone">Téléphone<span class="vert">*</span></label><input id="phone" name="phone" type="text"  placeholder="Votre numéro de téléphone"><br>
    <label for="rue">Rue<span class="vert">*</span></label><input id="rue" name="rue" type="text"  placeholder="Votre nom de rue"><br>
    <label for="num">Numéro<span class="vert">*</span></label><input id="num" name="num" type="text"  placeholder="Votre numéro"><br>
    <label for="ville">Ville<span class="vert">*</span></label><input id="ville" name="ville" type="text"  placeholder="Votre nom de ville"><br>
    <label for="localite">Localité<span class="vert">*</span></label><input id="localite" name="localite" type="text"  placeholder="Votre localité"><br>
    <label for="pays">Pays<span class="vert">*</span></label><input id="pays" name="pays" type="text"  placeholder="Votre pays"><br>
    <label for="avatar">Avatar</label><input id="avatar" type="file" name="avatar"/><br>
    <label for="visa">Carte VISA<span class="vert">*</span></label><input id="visa" type="text" name="visa"  placeholder="XXXX XXXX XXXX XXXX"/><br>
    <input class="button-3" name="btnOK" type="submit" value="S'inscrire" name="registerUser"><br>
    <p class="vert"><strong>* Ces informations sont requises.</strong></p>
  </form>
</div>

<?php else:
  header('Location:./index.php'); ?>
<?php endif; ?>

<!--INCLUDE FOOTER-->
<?php include("inc/footer.inc.php");?>

<!--FIN HTML-->
</body>
</html>
