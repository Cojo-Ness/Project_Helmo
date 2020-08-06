<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Accueil';
include("inc/head.inc.php");
?>

  <section id="new">
    <?php if(isset($_SESSION["ERROR"])){
      echo "<div id='error'>
      <p style='color:#000000; text-align:center;'>Votre compte a bien été supprimé</p>
      <ul>";
      foreach ($_SESSION["ERROR"] as $error){
        echo "<li>*" .$error."</li>";
      }
      echo "</ul>
      </div>";session_destroy();}?>
    <h2>Projets à la une<span class="vert">.</span></h2>
      <div id="conteneur-index">
        <article class="element-index">
        <a href="project.php#handspinner" class="transition">
          <img style="margin-top:5px;" src="./images/article1.jpg" alt="Un Hand Spinner">
          <h2  style="top:55px;">Le Hand Spinner</h2>
          <div class="overlay">
            <p style="color:black; font-size: 12px;">Un objet merveilleux, original et surtout déstressant.<br/>15.000€ sont demandés pour ce projet.<br>500% du projet déjà récolté.<br>Echéance : 01/01/2021.</p>
          </div>
        </a>
      </article>

    <article class="element-index">
      <a href="project.php#ring" class="transition">
        <img style="margin-top:5px;" src="./images/article2.jpg" alt="Un ring de combat de pouce">
        <h2 style="top:25px;">Le ring de combat de pouce</h2>
        <div class="overlay">
          <p style="color:black; font-size: 12px;">Pour des combats endiablé, mais surtout en règles.<br/>2.500€ sont demandés pour ce projet.<br>110% du projet récolté.<br>Echéance : 01/01/2021.</p>
        </div>
      </a>
    </article>

    <article class="element-index">
      <a href="project.php#ping-pong" class="transition">
        <img style="margin-top:5px;" src="./images/article3.jpg" alt="Une Raquette de Ping Pong">
        <h2  style="top:25px;">Raquette de ping-pong d'entraînement</h2>
        <div class="overlay">
          <p style="color:black; font-size: 12px;">Astuce : tapez avec les bords.<br/>1.000€ sont demandés pour ce projet<br>10% du projet récolté.<br>Echéance : 01/01/2021.</p>
        </div>
      </a>
    </article>

    <article class="element-index">
      <a href="project.php" class="transition">
        <img style="margin-top:5px;" src="./images/article4.jpg" alt="Des lunettes">
        <h2  style="top:25px;">Lunettes spéciales cyclopes</h2>
        <div class="overlay">
          <p style="color:black; font-size: 12px;">Car les cyclopes aussi ont le droit de profiter du soleil<br/>5.000€ sont demandés pour ce projet<br>100% du projet récolté.<br>Echéance : 01/01/2021.</p>
        </div>
      </a>
    </article>

    <article class="element-index">
      <a href="project.php" class="transition">
        <img style="margin-top:5px;" src="./images/article5.jpg" alt="Un verre de biere">
        <h2 style="top:45px;">Le verre de bière amicale</h2>
        <div class="overlay">
          <p style="color:black; font-size: 12px;">Pour passer de bons moments entre amis !<br/>10.000€ sont demandés pour ce projet<br>0% du projet récolté.<br>Echéance : 01/01/2021.</p>
        </div>
      </a>
    </article>

    <article class="element-index">
      <a href="project.php" class="transition">
        <img style="margin-top:5px;" src="./images/article12.jpg" alt="Une fourchette">
        <h2 style="top:50px;">Les couverts porte clés</h2>
        <div class="overlay">
          <p style="color:black; font-size: 12px;">Emportez votre fourchette partout.<br/>Déclinaison bientôt disponible.<br/>2.750€ sont demandés pour ce projet<br>50% du projet récolté.<br>Echéance : 01/01/2021.</p>
        </div>
      </a>
    </article>
  </div>
</section>

<h2>Projets par catégorie<span class="vert">.</span></h2>
<ul id="nav">
  <!--Divertissement-->
  <li><a href="#divertissement">Divertissement</a>
    <ul>
      <li><a href="#handspinner">Hand Spinner</a></li>
    </ul>
  </li>
  <!--Sport-->
  <li><a href="#sport">Sport</a>
    <ul>
      <li><a href="#ring">Le ring de combat de pouce</a></li>
      <li><a href="#ping-pong">Raquette de ping-pong d'entraînement</a></li>
    </ul>
  </li>
  <!--Electronique-->
  <li><a href="#electronique">Electronique</a>
    <ul>
    </ul>
  </li>
  <!--Bien être-->
  <li><a href="#bien-etre">Bien être</a>
    <ul>
    </ul>
  </li>
  <!--Jardinerie-->
  <li><a href="#jardinerie">Jardinerie</a>
    <ul>
    </ul>
  </li>
  <!--Mobilier-->
  <li><a href="#mobilier">Mobilier</a>
    <ul>
    </ul>
  </li>
  <!--Cuisine-->
  <li><a href="#cuisine">Cuisine</a>
    <ul>
      <li><a href="#couverts">Les couverts porte clés</a></li>
    </ul>
  </li>
  <!--Gaming-->
  <li><a href="#gaming">Gaming</a>
    <ul>
    </ul>
  </li>
  <!--Pop Culture-->
  <li><a href="#pop-culture">Pop Culture</a>
    <ul>
    </ul>
  </li>
  <!--Musique-->
  <li><a href="#musique">Musique</a>
    <ul>
    </ul>
  </li>
</ul>
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
          </tr>
          <tr id="handspinner">
            <td><img style="margin-top:5px;" src="./images/article1.jpg" alt="Un Hand Spinner"></td>
            <td>Le ring de combat de pouce.</td>
            <td>Un objet merveilleux, original et surtout déstressant.</td>
            <td>15.000€ sont demandés pour ce projet.</td>
            <td>01/01/2021.</td>
            <td>500% du projet à déjà été récolté, à vous ?</td>
            <td><input id="amount-article1" name="amount-article1" type="number" min="1" placeholder="Montant en euros"><br><input class="button-3" type="submit"></td>
          </tr>
        </tbody>
      </table>

      <!--Sport-->
      <h1 id="sport" class="titre-categorie">Sport<span class="vert">.</span></h1>
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
          </tr>
          <tr id="ring">
            <td><img style="margin-top:5px;" src="./images/article2.jpg" alt="Un ring de combat de pouce"></td>
            <td>Le ring de combat de pouce.</td>
            <td>Pour des combats endiablé, mais surtout en règles.</td>
            <td>2.500€ sont demandés pour ce projet.</td>
            <td>01/01/2021.</td>
            <td>110% du projet ont déjà été récolté, à vous ?</td>
            <td><input id="amount-article2" name="amount-article2" type="number" min="1" placeholder="Montant en euros"><br><input class="button-3" type="submit"></td>
          </tr>
          <tr id="ping-pong">
            <td><img style="margin-top:5px;" src="./images/article3.jpg" alt="Une Raquette de Ping Pong"></td>
            <td>Raquette de ping-pong d'entraînement.</td>
            <td>Astuce : tapez avec les bords.</td>
            <td>1.000€ sont demandés pour ce projet.</td>
            <td>01/01/2021.</td>
            <td>10% du projet récolté à déjà été récolté, à vous ?</td>
            <td><input id="amount-article3" name="amount-article3" type="number" min="1" placeholder="Montant en euros"><br><input class="button-3" type="submit"></td>
          </tr>
        </tbody>
      </table>

      <!--Electronique-->
      <h1 id="electronique" class="titre-categorie">Electronique<span class="vert">.</span></h1>
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
          </tr>
        </tbody>
      </table>

      <!--Bien être-->
      <h1 id="bien-etre" class="titre-categorie">Bien être<span class="vert">.</span></h1>
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
          </tr>
        </tbody>
      </table>

      <!--Jardinerie-->
      <h1 id="jardinerie" class="titre-categorie">Jardinerie<span class="vert">.</span></h1>
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
          </tr>
        </tbody>
      </table>

      <!--Mobilier-->
      <h1 id="mobilier" class="titre-categorie">Mobilier<span class="vert">.</span></h1>
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
          </tr>
        </tbody>
      </table>

      <!--Cuisine-->
      <h1 id="cuisine" class="titre-categorie">Cuisine<span class="vert">.</span></h1>
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
          </tr>
          <tr id="couverts">
            <td><img style="margin-top:5px;" src="./images/article12.jpg" alt="Une fourchette"></td>
            <td>Les couverts porte clés.</td>
            <td>Emportez votre fourchette partout.</td>
            <td>2.750€ sont demandés pour ce projet.</td>
            <td>01/01/2021.</td>
            <td>50% du projet récolté à déjà été récolté, à vous ?</td>
            <td><input id="amount-article12" name="amount-article12" type="number" min="1" placeholder="Montant en euros"><br><input class="button-3" type="submit"></td>
          </tr>
        </tbody>
      </table>

      <!--Gaming-->
      <h1 id="gaming" class="titre-categorie">Gaming<span class="vert">.</span></h1>
      <table>
        <tbody>
          <tr>
            <td>Images</td>
            <td>Intitulé</td>
            <td>Description</td>
            <td>Montant demandé</td>
            <td>Echéance</td>
            <td>participation globale</td>
            <td>Participer</td>
          </tr>
        </tbody>
      </table>

      <!--Pop Culture-->
      <h1 id="pop-culture" class="titre-categorie">Pop Culture<span class="vert">.</span></h1>
      <table>
        <tbody>
          <tr>
            <td>Images</td>
            <td>Intitulé</td>
            <td>Description</td>
            <td>Montant demandé</td>
            <td>Echéance</td>
            <td>participation globale</td>
            <td>Participer</td>
          </tr>
        </tbody>
      </table>

      <!--Musique-->
      <h1 id="musique" class="titre-categorie">Musique<span class="vert">.</span></h1>
      <table>
        <tbody>
          <tr>
            <td>Images</td>
            <td>Intitulé</td>
            <td>Description</td>
            <td>Montant demandé</td>
            <td>Echéance</td>
            <td>participation globale</td>
            <td>Participer</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="clear"></div>
    <!--INCLUDE FOOTER-->
    <?php include("inc/footer.inc.php"); ?>
  </body>
  </html>
