<?php
namespace User;
require 'db_link.inc.php';

use DB\DBLink;
use PDO;

/**
* Classe User : membre inscrit au site
*/
class User {
    public $id;
    public $lastname;
    public $firstname;
    public $password;
    public $login;
    public $email;
    public $phone;
    public $rue;
    public $num;
    public $localite;
    public $ville;
    public $pays;
    public $avatar;
    public $visa;

    public function __set($prop, $val){
        switch($prop){
            case "email": $this->$prop = strtolower($val); break;
            case "lastname": $this->$prop = strtoupper($val); break;
            default: $this->$prop = $val;
        }
    }
}

/**
* Classe UserRepository : gestionnaire du dépôt contenant les membres du site
*/
class UserRepository {
    const TABLE_NAME = 'col_membre';

    /**
    * Vérifie si une adresse email existe déjà en BD
    * @var string $email adresse email à vérifier
    * @var string $message ensemble des messages à retourner à l'utilisateur, séparés par un saut de ligne
    * @return boolean true si adresse existante, false sinon
    */
    public function existsInDB($email, &$message){
        $result = false;
        $bdd    = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM ".self::TABLE_NAME." WHERE email = :email");
            $stmt->bindValue(':email', $email);
            if ($stmt->execute()){
                if($stmt->fetch() !== false){
                    $result = true;
                }
            } else {
                $message .= 'Une erreur système est survenue.<br> Veuillez essayer à nouveau plus tard ou contactez l\'administrateur du site. (Code erreur E: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    /**
    * Enregistre le membre en base de données, l'email ne doit pas exister en base de données
    * @var User $user le membre à ajouter
    * @var string $message ensemble des messages à retourner à l'utilisateur, séparés par un saut de ligne
    * @return boolean true si opération réalisée sans erreur, false sinon
    */
    public function storeUser($user, &$message){
        $noError = false;
        $bdd   = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("INSERT INTO ".self::TABLE_NAME." (nom, prenom, mot_passe, pseudo, email, tel, adresse_rue, adresse_num, adresse_code, adresse_ville, adresse_pays, avatar, visa) VALUES (:nom, :prenom, :mot_passe, :pseudo, :email, :tel, :adresse_rue, :adresse_num, :adresse_code, :adresse_ville, :adresse_pays, :avatar, :visa)");
            $stmt->bindValue(':nom', $user->lastname);
            $stmt->bindValue(':prenom', $user->firstname);
            $stmt->bindValue(':mot_passe', $user->password);
            $stmt->bindValue(':pseudo', $user->pseudo);
            $stmt->bindValue(':email', $user->email);
            $stmt->bindValue(':tel', $user->phone);
            $stmt->bindValue(':adresse_rue', $user->rue);
            $stmt->bindValue(':adresse_num', $user->num);
            $stmt->bindValue(':adresse_code', $user->localite);
            $stmt->bindValue(':adresse_ville', $user->ville);
            $stmt->bindValue(':adresse_pays', $user->pays);
            $stmt->bindValue(':avatar', $user->avatar);
            $stmt->bindValue(':visa', $user->visa);
            if ($stmt->execute()){
                $message .= "Le courriel $user->email a été correctement ajouté à notre listing. <br> Nous vous remercions de votre intérêt pour les activités de notre association.<br>" ;
                $noError = true;
            } else {
                $message .= 'Une erreur système est survenue.<br> Veuillez essayer à nouveau plus tard ou contactez l\'administrateur du site. (Code erreur: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $noError;
    }

    /**
    * Retourne tous les inscrits au site
    * @var string $message ensemble des messages à retourner à l'utilisateur, séparés par un saut de ligne
    * @return [Member] liste des membres triés selon l'adresse email
    */
    public function getAllUsers(&$message){
        $result = array();
        $bdd    = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $result = $bdd->query("SELECT * FROM ".self::TABLE_NAME." ORDER BY email ASC;", PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Member\Member");

        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    /**
    * Retourne tous les inscrits au site qui contiennent le pattern donné
    * @var string $message ensemble des messages à retourner à l'utilisateur, séparés par un saut de ligne
    * @return [Member] liste des membres triés selon l'adresse email
    */
    public function getAllUsersByPattern($pattern, &$message){
        $result = array();
        $bdd    = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM ".self::TABLE_NAME." WHERE (email LIKE :pattern) OR (firstname LIKE :pattern) OR (lastname LIKE :pattern) ORDER BY email ASC;");
            $stmt->bindValue(':pattern', '%'.$pattern.'%');
            if ($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Member\Member");
            }


        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    /**
    * Retourne le membre correspondant à un identifiant
    * @var integer $id identifiant d'un membre
    * @var string $message ensemble des messages à retourner à l'utilisateur, séparés par un saut de ligne
    * @return User|null le membre associé à l'identifiant
    */
    public function getUserById($id, &$message){
        $result = null;
        $bdd    = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM ".self::TABLE_NAME." WHERE id = :id ORDER BY email ASC;");
            $stmt->bindValue(':id', $id);
            if ($stmt->execute()){
                $result = $stmt->fetchObject("Member\Member");
            } else {
                $message .= 'Une erreur système est survenue.<br> Veuillez essayer à nouveau plus tard ou contactez l\'administrateur du site. (Code erreur: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    /**
    * Supprime un membre sur base de son identifiant
    * @var integer $id identifiant du membre
    * @var string $message ensemble des messages à retourner à l'utilisateur, séparés par un saut de ligne
    * @return boolean true si opération réalisée sans erreur, false sinon
    */
    public function removeUserFromDB($id, &$message){
        $noError = false;
        $bdd   = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("DELETE FROM ".self::TABLE_NAME." WHERE id = :id");
            $stmt->bindValue(':id', $id);
            if($stmt->execute() && $stmt->rowCount() > 0){
                $noError = true;
            }
        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $noError;
    }
}
?>
