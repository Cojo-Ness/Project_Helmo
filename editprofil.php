<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Éditer Profil';
include("./inc/head.inc.php");
require "./php/userClass.php";
use User\UserManage;
$updateUser = new UserManage();
$updateUser->editUser();
$eraseUser = new UserManage();
$eraseUser->eraseUser();

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

<?php if (isset($_POST['eraseOK'])):?>
  <div id="conteneur-registration">
    <p>
      Vous êtes sûr ?
    </p>
    <form method="post" enctype="multipart/form-data">
    <input class="button-3-red" name="eraseConfirm" type="submit" value="Oui je suis sûr" >
    </form>
</div>

<?php else: ?>
  <div id="conteneur-registration">
    <form method="post" enctype="multipart/form-data">
      <label for="newNom">Nom</label><input id="newNom" name="newNom" type="text" autofocus value="<?php echo $_SESSION['nom'];?>"><br>
      <label for="newPrenom">Prénom </label><input id="newPrenom" name="newPrenom" type="text"  value="<?php echo $_SESSION['prenom'];?>"><br>
      <label for="newCourriel">Adresse email </label><input id="newCourriel" name="newCourriel" type="text"  value="<?php echo $_SESSION['courriel'];?>"><br>
      <label for="newLogin">Login </label><input id="newLogin" name="newLogin" type="text"  value="<?php echo $_SESSION['login'];?>"><br>
      <label for="newPhone">Téléphone </label><input id="newPhone" name="newPhone" type="text"  value="<?php echo $_SESSION['tel'];?>"><br>
      <label for="newRue">Rue </label><input id="newRue" name="newRue" type="text"  value="<?php echo $_SESSION['adresse_rue'];?>"><br>
      <label for="newNum">Numéro </label><input id="newNum" name="newNum" type="text"  value="<?php echo $_SESSION['adresse_num'];?>"><br>
      <label for="newVille">Ville </label><input id="newVille" name="newVille" type="text"  value="<?php echo $_SESSION['adresse_ville'];?>"><br>
      <label for="newLocalite">Localité </label><input id="newLocalite" name="newLocalite" type="text"  value="<?php echo $_SESSION['adresse_code'];?>"><br>
      <label for="newPays">Pays </label><input id="newPays" name="newPays" type="text"  value="<?php echo $_SESSION['adresse_pays'];?>"><br>
      <label for="avatar">Avatar</label><input id="avatar" type="file" name="avatar"/><br>
      <label for="newVisa">Carte VISA </label><input id="newVisa" type="text" name="newVisa"  value="<?php echo $_SESSION['carte_VISA'];?>"/><br>
      <input class="button-3" name="btnOK" type="submit" value="Modifier" >
      <input class="button-3-red" name="eraseOK" type="submit" value="Supprimer mon profil" >
    </form>
  </div>
<?php endif; ?>


<?php else: header('Location:./index.php');?>
  <?php endif; ?>
  <!--INCLUDE FOOTER-->
  <?php include("inc/footer.inc.php"); ?>
</body>
</html>
