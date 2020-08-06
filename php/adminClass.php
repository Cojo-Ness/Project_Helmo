<?php
namespace Admin;
require './inc/db_link.inc.php';
use DB\DBLink;
require './php/functions.php';

class AdminManager{

  function addCategory(){
    $bdd = null;
    $donnes=null;
    if (isset($_POST['btnOK'])) {
      /*CONNEXION BD + REQ*/
      $bdd  = DBLink::connect2db(MYDB);
      $req = $bdd->prepare('SELECT count(categorie) AS idk from col_categorie WHERE categorie = ?');
      $req->execute(array($_POST['addCat']));
      $req = $req->fetch();
      echo $req['idk'];
      /*VARIABLE ERREURS*/
      $errors = array();

      /*CAT*/
      if (empty($_POST['addCat'])){
        echo "test";
        $errors['addCat'] = "Veuillez remplir le champ de l'ajout.";
      }

      elseif ($req['idk'] >= 1) {
        echo $req['idk'];
        $errors['addCat'] = 'Cette catégorie existe déjà';
      }

      /*-------------------------*/
      if (empty($errors)) {
          $req = $bdd->prepare("INSERT INTO col_categorie (categorie) VALUES(?)");
          $req->execute(array($_POST['addCat']));
          DBLink::disconnect($bdd);
          header('Location:./admin.php');
        }
      else {
        $_SESSION["ERROR"] = $errors;
        header('Location:./addcat.php');
      }
      exit();
    }
  }

  function editCategory(){

  }

  function eraseCategory(){
    // $id = checkInput($_POST['id']);
    // $statement = $db->query("DELETE FROM items WHERE id = ?",array($id));
    // header("Location: index.php");
  }















}
