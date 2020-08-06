<!DOCTYPE html>
<html lang="fr">
<head>
  <link href="./css/style.css" rel="stylesheet">
  <meta charset="utf-8">
  <link href="./images/shortcuticon.jpg" rel="shortcut icon" >
  <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/8b9f1bac47.js" crossorigin="anonymous"></script> -->
  <title>Collect'Or - <?php echo $titre; ?></title>
</head>
<body>
  <header>
    <div class="wrapper">
      <a href="index.php"><h1>Collect'Or<span class="vert">.</span></h1></a>
      <nav>
        <ul>
          <li><a href="index.php">Accueil</a></li>

          <li><a href="project.php">Projets</a></li>
          <li><a href="contact.php">Contacts</a></li>
          <?php
          if (isset($_SESSION['est_admin']) == 1 && isset($_SESSION['loggedIn']) == true) {
            echo "<li><a href='admin.php'>Espace Admin</a></li>";
          }
          if (isset($_SESSION['loggedIn']) != true) {
            echo "<li><a href='login.php'>Connexion</a></li>";
          } else {
            echo "<li><a href='profil.php'>Profil</a></li>";
            echo "<li><a href='./php/logout.php'>Déconnexion</a></li>";
          }
          ?>
        </ul>
      </nav>
    </div>
  </header>
