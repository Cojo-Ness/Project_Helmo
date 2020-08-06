<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Projets';
include("./inc/head.inc.php");
?>

  <section id="new">
    <h1>Choisir sa catégorie<span class="vert">.</span></h1>
    <!--Nav Bar-->
    <ul id="nav">
      <!--Divertissement-->
      <li><a href="#divertissement">Divertissement</a>
        <ul>
          <li><a href="#handspinner">Hand Spinner</a></li>
        </ul>
      </li>
    </ul>
  </section>

    <div id="conteneur-project">
      <!--Divertissement-->
      <h1 id="divertissement" class="titre-categorie">Divertissement<span class="vert">.</span></h1>
      <table>
        <tbody>
          <tr>
            <td>Images</td>
            <td>Intitulé</td>
            <td>Description</td>
            <td>Montant demandé</td>
            <td>Echéance</td>
            <td>Participation globale</td>
            <td>Participer</td>
            <td>News</td>
            <td>Derniers commentaires</td>
          </tr>
          <tr id="handspinner">
            <td><img style="margin-top:5px;" src="images/article1.jpg" alt="Un Hand Spinner"></td>
            <td>Le ring de combat de pouce.</td>
            <td>Pour des combats endiablé, mais surtout en règles.</td>
            <td>2.500€ sont demandés pour ce projet.</td>
            <td>01/01/2021.</td>
            <td>110% du projet à déjà été récolté, à vous ?</td>
            <td><input id="amount" name="amount" type="number" min="1" placeholder="Montant en euros"><br><input class="button-3" type="submit"></td>
            <td>Le montant demandé a diminué de 500€. Profitez-en</td>
            <td>Depuis que je l'ai reçu je ne m'en sépare pas !<br><br>Sans aucun doute mon meilleur achat de cette année</td>
          </tr>
        </tbody>
      </table>
    </div>

      <div class="clear"></div>

      <!--INCLUDE FOOTER-->
      <?php include("inc/footer.inc.php");?>
    </body>
    </html>
