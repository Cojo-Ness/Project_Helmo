<?php
use DB\DBLink;
/*FONCTION LUHN POUR VISA*/
function Luhn($numero,$longueur){
// On passe à la fonction la variable contenant le numéro à vérifier
// et la longueur qu'il doit impérativement avoir

    $numero = str_replace('-','',$numero);
    $numero = str_replace(' ','',$numero);

    if ((strlen($numero)==$longueur) && preg_match("#[0-9]{".$longueur."}#i", $numero)){
// si la longueur est bonne et que l'on n'a que des chiffres

        /* on décompose le numéro dans un tableau  */
        for ($i=0;$i<$longueur;$i++){
            $tableauChiffresNumero[$i]=substr($numero,$i,1);
        }

        /* on parcours le tableau pour additionner les chiffres */
        $luhn=0; // clef de luhn à tester
        for ($i=0;$i<$longueur;$i++){
            if ($i%2==0){ // si le rang est pair (0,2,4 etc.)
                if(($tableauChiffresNumero[$i]*2) > 9){
                  // On regarde si son double est > à 9
                    $tableauChiffresNumero[$i]=($tableauChiffresNumero[$i]*2)-9;
                    //si oui on lui retire 9
                    // et on remplace la valeur
                    // par ce double corrigé
                }
                else{
                    $tableauChiffresNumero[$i]=$tableauChiffresNumero[$i]*2;
                    // si non on remplace la valeur
                    // par le double
                }
            }
            $luhn=$luhn+$tableauChiffresNumero[$i];
            // on additionne le chiffre à la clef de luhn
        }

        /* test de la divition par 10 */
        if($luhn%10==0){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
        // la valeur fournie n'est pas conforme (caractère non numérique ou mauvaise
        // longueur)
    }
  }

/*FONCTION GENERER STR RANDOM*/
function str_random($lenght){
  $alphabet = "0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
  return substr(str_shuffle(str_repeat($alphabet,$lenght)),0,$lenght);
}
