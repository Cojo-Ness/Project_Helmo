<?php
namespace User;
require './inc/db_link.inc.php';
use DB\DBLink;
require './php/functions.php';

class UserManage{

  function registerUser(){
    $bdd = null;
    if (isset($_POST['btnOK'])) {
      /*CONNEXION BD + REQ*/
      $bdd  = DBLink::connect2db(MYDB);
      $req = $bdd->prepare('SELECT * from col_membre where login = ? AND courriel = ?');
      $req->execute(array($_POST['login'],$_POST['courriel']));
      $req = $req->fetch();

      /*VARIABLE ERREURS*/
      $errors = array();

      /*LOGIN*/
      if (empty($_POST['login'])){
        $errors['login'] = "Veuillez remplir le champ du pseudo.";
      }

      elseif (!preg_match('/^[A-Za-z0-9_-]+$/', $_POST['login'])) {
        $errors['login'] = "Le login ne correspond pas au norme de syntaxe.";
      }

      elseif ($req['login']) {
        $errors['login'] = 'Ce pseudo est déjà pris';
      }

      /*COURRIEL*/
      if (empty($_POST['courriel'])){
        $errors['courriel'] = "Veuillez remplir le champ du courriel.";
      }

      elseif (!filter_var($_POST['courriel'], FILTER_VALIDATE_EMAIL)){
        $errors['courriel'] = "L'adresse email est incorrect";
      }

      elseif ($req['courriel']) {
          $errors['courriel'] = 'Cet email est déjà pris';
        }

      /*PASSWORD*/
      if (empty($_POST['password'])){
        $errors['password'] = "Veuillez remplir le premier champ du mot de passe.";
      }

      elseif (empty($_POST['verifpassword'])){
        $errors['password'] = "Veuillez remplir le second champ du mot de passe.";
      }

      elseif (empty($_POST['password']) || $_POST['password'] != $_POST['verifpassword']){
        $errors['password'] = "Les mots de passe ne correspondent pas";
      }

      /*NOM + PRENOM*/
      if (empty($_POST['prenom'])){
        $errors['prenom'] = "Veuillez remplir le champ du prénom.";
      }

      if (empty($_POST['nom'])){
        $errors['nom'] = "Veuillez remplir le champ du nom.";
      }

      /*TELEPHONE*/
      if (empty($_POST['phone'])){
        $errors['phone'] = "Veuillez remplir le champ du téléphone.";
      }

      /*ADRESSE*/
      if (empty($_POST['rue'])){
        $errors['rue'] = "Veuillez remplir le champ de la rue.";
      }

      if (empty($_POST['num'])){
        $errors['num'] = "Veuillez remplir le champ du n° de maison.";
      }

      if (empty($_POST['ville'])){
        $errors['ville'] = "Veuillez remplir le champ de la ville.";
      }

      if (empty($_POST['localite'])){
        $errors['localite'] = "Veuillez remplir le champ de la localité.";
      }

      if (empty($_POST['pays'])){
        $errors['pays'] = "Veuillez remplir le champ du pays.";
      }

      /*AVATAR*/
      if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
        $tailleMax = 2097152;
        $extensionValide = array('jpg','jpeg','gif','png');
        if ($_FILES['avatar']['size'] <= $tailleMax) {
          $extensionFichier = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'), 1));
          if (in_array($extensionFichier,$extensionValide)) {
            $randomFileName = str_random(10);
            $path = "./uploads/".$randomFileName.".".$extensionFichier;
            /*SI FICHIER EXIST DEJA*/
            while (file_exists($path)) {
              $randomFileName = str_random(10);
              $path = "./uploads/".$randomFileName.".".$extensionFichier;
            }
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
            if ($resultat) {
              $avatar = $randomFileName.".".$extensionFichier;
            }
            else {
              $errors['avatar'] = "Erreur durant l'importation du fichier";
            }
          }
          else {
            $errors['avatar'] = "La photo de profil ne doit être au format jpg, jpeg, gif, png.";
          }
        }
        else {
          $errors['avatar'] = "La photo de profil ne doit pas dépasser 2Mo.";
        }
      }
      else {
        $avatar = "";
      }

      /*VISA*/
      if (empty($_POST['visa'])){
        $errors['visa'] = "Veuillez remplir le champ de la VISA.";
      }

      elseif (!Luhn($_POST['visa'],16)){
        $errors['visa'] = "Numéro de carte VISA non valide.";
      }

      /*-------------------------*/
      if (empty($errors)) {
        $prenom = htmlentities($_POST['prenom']);
        $nom = htmlentities($_POST['nom']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = htmlentities($_POST['courriel']);
        $pseudo = htmlentities($_POST['login']);
        $phone = htmlentities($_POST['phone']);
        $rue = htmlentities($_POST['rue']);
        $num = htmlentities($_POST['num']);
        $localite = htmlentities($_POST['localite']);
        $ville = htmlentities($_POST['ville']);
        $pays = htmlentities($_POST['pays']);
        $visa = htmlentities($_POST['visa']);
        $req = $bdd->prepare("INSERT INTO col_membre (login, prenom, nom, mot_passe, courriel, tel, adresse_rue, adresse_num, adresse_code, adresse_ville, adresse_pays, avatar, carte_VISA) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $req->execute(array($pseudo,$prenom,$nom,$password,$email,$phone,$rue,$num,$localite,$ville,$pays,$avatar,$visa));
        mail($_POST['courriel'],'Création du compte Collector','Votre compte a bien été crée !');
        DBLink::disconnect($bdd);
        header('Location:./login.php');
      }

      else {
        $_SESSION["ERROR"] = $errors;
        header('Location:./registration.php');
      }
      exit();
    }
  }


  function loginUser(){
    $bdd = null;
    if (isset($_POST['btnOK'])) {

      $login = htmlspecialchars($_POST['login']);
      $hash = $_POST['mot_passe'];

      /*CONNEXION BD + REQ*/
      $bdd  = DBLink::connect2db(MYDB);
      $req = $bdd->prepare("SELECT mot_passe,login FROM col_membre WHERE login = ?");
      $req->execute(array($login));
      $req = $req->fetch();

      /*VARIABLE ERREURS*/
      $errors = array();

      /*LOGIN*/
      if (empty($_POST['login'])){
        $errors['login'] = "Veuillez remplir le champ du pseudo.";
      }

      elseif (!preg_match('/^[A-Za-z0-9_-]+$/', $_POST['login'])) {
        $errors['login'] = "Le login ne correspond pas au norme de syntaxe.";
      }

      elseif (strcmp($login,$req['login'])) {
        $errors['login'] = "Login incorrect.";
      }

      /*PASSWORD*/
      if (empty($_POST['mot_passe'])){
        $errors['mot_passe'] = "Veuillez remplir le champ du mot de passe.";
      }

      elseif (!password_verify($hash,$req['mot_passe'])) {
        $errors['mot_passe'] = "Mot de passe incorrect.";
      }

      /*-------------------------*/
      if (empty($errors)) {
        if (!empty($req['mot_passe'])) {
          if (password_verify($hash,$req['mot_passe'])) {
            $req = $bdd->prepare("SELECT * FROM col_membre WHERE login = ?");
            $req->execute(array($login));
            $userinfo = $req->fetch();
            $_SESSION['id_membre'] = $userinfo['id_membre'];
            $_SESSION['login'] = $userinfo['login'];
            $_SESSION['prenom'] = $userinfo['prenom'];
            $_SESSION['nom'] = $userinfo['nom'];
            $_SESSION['courriel'] = $userinfo['courriel'];
            $_SESSION['tel'] = $userinfo['tel'];
            $_SESSION['adresse_rue'] = $userinfo['adresse_rue'];
            $_SESSION['adresse_num'] = $userinfo['adresse_num'];
            $_SESSION['adresse_code'] = $userinfo['adresse_code'];
            $_SESSION['adresse_ville'] = $userinfo['adresse_ville'];
            $_SESSION['adresse_pays'] = $userinfo['adresse_pays'];
            $_SESSION['avatar'] = $userinfo['avatar'];
            $_SESSION['carte_VISA'] = $userinfo['carte_VISA'];
            $_SESSION['est_desactive'] = $userinfo['est_desactive'];
            $_SESSION['est_admin'] = $userinfo['est_admin'];
            $_SESSION['loggedIn'] = true;
            retreiveBadges();
            DBLink::disconnect($bdd);
            header("Location:./profil.php");
          }
        }
      }
      else {
        $_SESSION["ERROR"] = $errors;
        header("Location:login.php");
      }
      exit();
    }
  }

  function editUser(){
    $bdd = null;
    if (isset($_POST['btnOK'])) {
      /*CONNEXION BD + REQ*/
      $bdd  = DBLink::connect2db(MYDB);
      $req = $bdd->prepare('SELECT * from col_membre where login = ? AND courriel = ?');
      $req->execute(array($_POST['login'],$_POST['courriel']));
      $req = $req->fetch();

      $errors = array();

      /*LOGIN*/
      if (empty($_POST['newLogin'])){
        $errors['login'] = "Veuillez remplir le champ du pseudo.";
      }

      elseif (!preg_match('/^[A-Za-z0-9_-]+$/', $_POST['newLogin'])) {
        $errors['login'] = "Le login ne correspond pas au norme de syntaxe.";
      }

      elseif ($req['login'] && $_SESSION['login'] != $req['login']) {
        $errors['login'] = 'Ce pseudo est déjà pris';
      }

      /*COURRIEL*/
      if (empty($_POST['newCourriel'])){
        $errors['courriel'] = "Veuillez remplir le champ du courriel.";
      }

      elseif (!filter_var($_POST['newCourriel'], FILTER_VALIDATE_EMAIL)){
        $errors['courriel'] = "L'adresse email est incorrect";
      }

      elseif ($req['courriel'] && $_SESSION['courriel'] != $req['courriel']) {
          $errors['courriel'] = 'Cet email est déjà pris';
        }

      /*NOM + PRENOM*/
      if (empty($_POST['newPrenom'])){
        $errors['Prenom'] = "Veuillez remplir le champ du prénom.";
      }

      if (empty($_POST['newNom'])){
        $errors['Nom'] = "Veuillez remplir le champ du nom.";
      }

      /*TELEPHONE*/
      if (empty($_POST['newPhone'])){
        $errors['phone'] = "Veuillez remplir le champ du téléphone.";
      }

      /*ADRESSE*/
      if (empty($_POST['newRue'])){
        $errors['rue'] = "Veuillez remplir le champ de la rue.";
      }

      if (empty($_POST['newNum'])){
        $errors['num'] = "Veuillez remplir le champ du n° de maison.";
      }

      if (empty($_POST['newVille'])){
        $errors['ville'] = "Veuillez remplir le champ de la ville.";
      }

      if (empty($_POST['newLocalite'])){
        $errors['localite'] = "Veuillez remplir le champ de la localité.";
      }

      if (empty($_POST['newPays'])){
        $errors['pays'] = "Veuillez remplir le champ du pays.";
      }

      /*AVATAR*/
      if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
        $tailleMax = 2097152;
        $extensionValide = array('jpg','jpeg','gif','png');
        if ($_FILES['avatar']['size'] <= $tailleMax) {
          $extensionFichier = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'), 1));
          if (in_array($extensionFichier,$extensionValide)) {
            $randomFileName = str_random(10);
            $path = "./uploads/".$randomFileName.".".$extensionFichier;
            while (file_exists($path)) {
              $randomFileName = str_random(10);
              $path = "./uploads/".$randomFileName.".".$extensionFichier;
            }
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
            if ($resultat) {
              $avatar = $randomFileName.".".$extensionFichier;
            }
            else {
              $errors['avatar'] = "Erreur durant l'importation du fichier";
            }
          }
          else {
            $errors['avatar'] = "La photo de profil ne doit être au format jpg, jpeg, gif, png.";
          }
        }
        else {
          $errors['avatar'] = "La photo de profil ne doit pas dépasser 2Mo.";
        }
      }
      else {
      $avatar = $_SESSION['avatar'];
      }

      /*VISA*/
      if (empty($_POST['newVisa'])){
        $errors['visa'] = "Veuillez remplir le champ de la VISA.";
      }

      elseif (!Luhn($_POST['newVisa'],16)){
        $errors['visa'] = "Numéro de carte VISA non valide.";
      }

      /*REQUETE + ERRORS*/
      if (empty($errors)) {
        $prenom = htmlentities($_POST['newPrenom']);
        $nom = htmlentities($_POST['newNom']);
        $password = password_hash($req['mot_passe'], PASSWORD_BCRYPT);
        $email = htmlentities($_POST['newCourriel']);
        $pseudo = htmlentities($_POST['newLogin']);
        $phone = htmlentities($_POST['newPhone']);
        $rue = htmlentities($_POST['newRue']);
        $num = htmlentities($_POST['newNum']);
        $localite = htmlentities($_POST['newLocalite']);
        $ville = htmlentities($_POST['newVille']);
        $pays = htmlentities($_POST['newPays']);
        $visa = htmlentities($_POST['newVisa']);
        $req = $bdd->prepare("UPDATE col_membre SET login = ?, prenom = ?, nom = ?, mot_passe = ?, courriel = ?, tel = ?, adresse_rue = ?, adresse_num = ?, adresse_code = ?, adresse_ville = ?, adresse_pays = ?, avatar = ?, carte_VISA = ? WHERE id_membre = ?");
        $req->execute(array($pseudo,$prenom,$nom,$password,$email,$phone,$rue,$num,$localite,$ville,$pays,$avatar,$visa,$_SESSION['id_membre']));
        $_SESSION['login'] = $pseudo;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['courriel'] = $email;
        $_SESSION['tel'] = $phone;
        $_SESSION['adresse_rue'] = $rue;
        $_SESSION['adresse_num'] = $num;
        $_SESSION['adresse_code'] = $localite;
        $_SESSION['adresse_ville'] = $ville;
        $_SESSION['adresse_pays'] = $pays;
        $_SESSION['avatar'] = $avatar;
        $_SESSION['carte_VISA'] = $visa;
        DBLink::disconnect($bdd);
        header('Location:./profil.php');
      }
      else {
        $_SESSION["ERROR"] = $errors;
        header('Location:editprofil.php');
      }
      exit();
    }
  }

  function editPasswordUser(){
    $bdd = null;
    if (isset($_POST['btnOK'])) {
      /*CONNEXION BD + REQ*/
      $bdd  = DBLink::connect2db(MYDB);
      $req = $bdd->prepare('SELECT mot_passe from col_membre where id_membre = ?');
      $req->execute(array($_SESSION['id_membre']));
      $req = $req->fetch();
      $newPassword  = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);

      /*PASSWORD ACTUEL*/
      if(empty($_POST['password'])){
        $errors['password'] = "Veuillez remplir le champ du mot de passe actuel.";
      }

      elseif (!password_verify($_POST['password'], $req['mot_passe'])){
        $errors['password'] = "Le mot de passe entré n'est pas votre mot de passe actuel";
      }

      /*NEW PASSWORD*/
      if (empty($_POST['newPassword'])){
        $errors['newPassword'] = "Veuillez remplir le premier champ du nouveau mot de passe.";
      }

      /*NEW PASSWORD VERIF*/
      if (empty($_POST['verifNewPassword'])){
        $errors['verifNewPassword'] = "Veuillez remplir le second champ du nouveau mot de passe.";
      }

      elseif ($_POST['newPassword'] != $_POST['verifNewPassword']){
        $errors['verifNewPassword'] = "Les nouveaux mots de passe ne correspondent pas";
      }

      if (empty($errors)) {
        $req = $bdd->prepare("UPDATE col_membre SET mot_passe = ? WHERE id_membre = ?");
        $req->execute(array($newPassword,$_SESSION['id_membre']));
        DBLink::disconnect($bdd);
        header('Location:./profil.php');
      }
      else {
        $_SESSION["ERROR"] = $errors;
        header('Location: editpasswordprofil.php');
        exit();
      }
    }
  }

  function eraseUser(){
    $req = null;
    if (isset($_POST['eraseConfirm'])) {
      $bdd  = DBLink::connect2db(MYDB);
      $req = $bdd->prepare('SELECT est_desactive from col_membre where id_membre = ?');
      $req->execute(array($_SESSION['id_membre']));
      $req = $req->fetch();
      if ($req['est_desactive'] == null) {
        $req = $bdd->prepare("DELETE FROM col_membre WHERE id_membre = ?");
        $req->execute(array($_SESSION['id_membre']));
      }
      else {
        $req = $bdd->prepare("UPDATE col_membre SET est_desactive = ? WHERE id_membre = ?");
        $req->execute(array(1,$_SESSION['id_membre']));
        DBLink::disconnect($bdd);
      }

      $errors['eraseProfile'] = "Votre compte a bien été supprimé";
      $_SESSION["ERROR"] = $errors;
      header('Location: index.php');
      exit();
    }
  }

  function logOutUser(){
    session_start();
    session_destroy();
    header("Location:../index.php");
  }

  function retreiveCommentsCount() {
    $comment_count = $comment_count->prepare("SELECT COUNT(id_membre) as com_count from col_commentaire WHERE id_membre = ?");
    $comment_count->execute(array($_SESSION['id_membre']));
    return $req['com_count'];
  }

  function retreiveProjetsCount() {
    $projet_count = $projet_count->prepare("SELECT COUNT(id_membre) as project_count from col_projet WHERE id_membre = ?");
    $projet_count->execute(array($_SESSION['id_membre']));
    return $req['project_count'];
  }


  function retreiveBadges() {
    $badges = array();
    $comment_count = retreiveCommentsCount();
    $project_count = retreiveProjetsCount();
    if($comment_count >= 3) {
      $badge_info = $badge_info->prepare("SELECT * from col_badge WHERE nom = 'Trois commentaires'");
      array_push($badges, $project_count->fetch());
    }
    elseif($comment_count >= 10) {
      $badge_info = $badge_info->prepare("SELECT * from col_badge WHERE nom = 'Dix commentaires'");
      array_push($badges, $project_count->fetch());
    }
    elseif($project_count >= 3) {
      $badge_info = $badge_info->prepare("SELECT * from col_badge WHERE nom = 'Trois commentaires'");
      array_push($badges, $project_count->fetch());
    }
    $_SESSION['badge'] = $badges;
  }
}