<?php
namespace Contact;
require './inc/db_link.inc.php';
use DB\DBLink;
require './php/functions.php';

class ContactManage{

  function sendMessage(){
    $bdd = null;
    if (isset($_POST['btnOK'])) {
      /*COURRIEL*/
      if (empty($_POST['courriel'])){
        $errors['courriel'] = "Veuillez remplir le champ du courriel.";
      }

      elseif (!filter_var($_POST['courriel'], FILTER_VALIDATE_EMAIL)){
        $errors['courriel'] = "L'adresse email est incorrect";
      }

      // /*OBJECT*/
      if (empty($_POST['object'])){
        $errors['object'] = "Veuillez remplir le champ de l'objet du message.";
      }

      // /*MESSAGE*/
      if (empty($_POST['message'])){
        $errors['message'] = "Veuillez remplir le champ du message.";
      }

      $_SESSION["ERROR"] = $errors;

      /*SEND MESSAGE*/
      if (empty($errors)) {
        $bdd  = DBLink::connect2db(MYDB);
        $req = $bdd->query('SELECT courriel from col_membre where est_admin = 1');
        mail($_POST['courriel'], $_POST['object'], "Email : ".$_POST['courriel']."\n".$_POST['message']);
        while ($donnees = $req->fetch()){
          mail($donnees['courriel'], $_POST['object'], "Email : ".$_POST['courriel']."\n".$_POST['message']);
        }
        DBLink::disconnect($bdd);
        $errors["SEND"] = "Mesage bien envoyé";
        $_SESSION["SEND"] = $errors;
      }

      header('Location:contact.php');
      exit();
   }

 }









}
