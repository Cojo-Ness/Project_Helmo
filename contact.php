<!--INCLUDE HEAD + VARIABLE SESSION-->
<?php
session_start();
$titre = 'Contact';
include("./inc/head.inc.php");
require "./php/contactClass.php";
use Contact\ContactManage;
$message = new ContactManage();
$message->sendMessage();?>

<div class="clear"></div>
<section id="contact">
  <div class="wrapper">
    <h3>Contactez-nous<span class="vert">.</span></h3>
    <?php
    if (isset($_SESSION["SEND"])) {
      foreach ($_SESSION["SEND"] as $send){
        echo "<div id='send'>
        <p style='color:#000000; text-align:center;'>".$send."</p></div>";
      }
    }
    unset($_SESSION["SEND"]);

    if(isset($_SESSION["ERROR"])){

      echo "<div id='error'>
      <p style='color:#000000; text-align:center;'>Vous n'avez pas rempli le formulaire correctement</p>
      <ul>";
      foreach ($_SESSION["ERROR"] as $error){
        echo "<li>*" .$error."</li>";
      }
      echo "</ul>
      </div>";unset($_SESSION["ERROR"]);}?>
      <form method="post">
        <label for="courriel">Votre email : </label><br>
        <input id="courriel" name="courriel" type="text" size="39"><br><br>
        <label for="object">Objet du message : </label><br>
        <input id="object" name="object" type="text" size="39"><br><br>
        <label for="message">Message : </label><br>
        <textarea id="message" name="message" rows="5" cols="40"></textarea><br><br>
        <input class="button-3" name="btnOK" type="submit" value="Envoyer" name="sendMessage">
      </form>
    </div>
  </section>

  <!--INCLUDE FOOTER-->
  <?php include("inc/footer.inc.php"); ?>
</body>
</html>
