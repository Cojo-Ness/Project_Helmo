<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Profil';
include("./inc/head.inc.php");
?>

<?php if (isset($_SESSION['loggedIn']) != false): ?>
<h1 style="margin-top:25px;">Votre profil<span class="vert">.</span></h1>
<div id="conteneur-registration">
  <h1 style="margin-top:25px;">Bonjour<span class="vert">.</span></h1>

  <form>
    <label>Nom: <?php echo $_SESSION['nom'];?></label>
    <label>Prénom: <?php echo $_SESSION['prenom'];?></label>
    <label>Adresse email:<br> <?php echo $_SESSION['courriel'];?></label>
    <label>Pseudo: <?php echo $_SESSION['login'];?></label><br>
    <br><label>Avatar</label><br><?php if (!empty($_SESSION['avatar'])) {echo "<img src='./uploads/".$_SESSION['avatar']."' style='width:100px;' alt='avatar'";}else {echo "none";}?><br><br>
    <label>Ville: <?php echo $_SESSION['adresse_ville'];?></label>
    <label>Rue: <?php echo $_SESSION['adresse_rue'];?></label>
    <label>Code Postal: <?php echo $_SESSION['adresse_code'];?></label>
    <label>N°<?php echo $_SESSION['adresse_num'];?></label>
    <label>Carte Visa: <br> <?php echo $_SESSION['carte_VISA'];?></label><br>
    <a class="button-3" href="editprofil.php">Éditer le profil</a><br><br>
    <a class="button-3" href="editpasswordprofil.php">Modifier le mot de passe</a><br><br>
    <hr>

    <h1 style="margin-top:25px;">Vos projets<span class="vert">.</span></h1>
    <label>Catégorie</label>
    <select>
      <option value="divertissement">Divertissement</option>
      <option value="sport">Sport</option>
    </select><br>
    <label for="project-name">Projet</label><input id="project-name" name="project-name" type="text" placeholder="Nom du projet"><br>
    <label for="picture">Photo</label><input id="picture" name="picture" type="file"><br>
    <label for="amount">Objectif</label><input id="amount" name="amount" type="number" min="1" placeholder="Montant à atteindre"><br>
    <label for="date">Echéance</label><input id="date" name="date" type="date"><br>
    <label for="description-projet">Description</label><br><textarea id="description-projet" name="description" rows="2"></textarea><br>
    <label for="amount-give">Montant requis (min)</label><input id="amount-give" name="amount-give" type="number" min="1" placeholder="Montant en euros"><br>
    <label for="visa">Carte VISA</label><input type="text" name="visa" id="visa" placeholder="Votre n° de carte VISA"/><br>
    <label for="name">Nom</label><input id="name" name="name" type="text"   placeholder="Votre nom"><br>
    <label for="first-name">Prénom</label><input id="first-name" name="first-name" type="text"   placeholder="Votre prénom"><br>
    <a class="button-3" href="addproject.php">Éditer le profil</a>
    <hr>

    <h1 style="margin-top:25px;">News<span class="vert">.</span></h1>
    <label for="news-title">Intitulé de la news</label><input id="news-title" name="news-title" type="text" placeholder="Titre"><br>
    <label for="description-news">Description</label><br><textarea id="description-news" name="description" rows="2"></textarea>
    <hr>
    <h1 style="margin-top:25px;">Mes badges<span class="vert">.</span></h1>
    <label for="news-title">Badges</label><!-- BADGES ICI BB JTM-->

  </form>

  </div>

<?php else:
  header('Location:./index.php'); ?>
<?php endif; ?>
  <!--INCLUDE FOOTER-->
  <?php include("inc/footer.inc.php"); ?>
</body>
</html>
