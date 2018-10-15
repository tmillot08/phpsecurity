<?php
session_start();
require 'connection.php';
$nom = htmlspecialchars($_POST["nom"]);
$fnom = htmlspecialchars($_POST["fnom"]);
$mail = htmlspecialchars($_POST["mail"]);
$zipcode = htmlspecialchars($_POST["zipcode"]);
$password = htmlspecialchars($_POST["password"]);
$cpassword = htmlspecialchars($_POST["cpassword"]);
$ip = get_ip();



if (isset($_POST["submit"])) {//execute when we submit a form
    if (empty($nom) || empty($fnom) ||  empty($mail) || empty($zipcode) || empty($password) || empty($cpassword)){//verify if input are empty
      $_SESSION["error"] = "tout les champs ne sont pas remplit";
      header("Location:index.php");
    } else {
      if (!preg_match("/^[a-zA-Z ]*$/",$nom) || !preg_match("/^[a-zA-Z ]*$/",$fnom)) {//verify char 
        $_SESSION["error"] = "le nom ou le prenom n'est pas correcte";
        header("Location:index.php");
      }else{
        if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail)) {//verify mail adress
            $_SESSION["error"] = "le mail n'est pas valide";
            header("Location:index.php");
          }else{
            if (!preg_match('#^[0-9]{5}$#', $zipcode))  {//verify US and EU Zipcode 
                $_SESSION["error"] = "le code postal n'est pas valide";
                header("Location:index.php");
              }else{
                if ($password != $cpassword)  {// match password 1 and password 2
                        $_SESSION["error"] = "les mot de passe sont différent";
                        header("Location:index.php");
                      }else{
                        $dbh = connect();
                        $requeteEmail = $dbh->prepare("Select mail FROM User WHERE mail=:mail");
                        $requeteEmail->bindParam(":mail",$Email);
                        $requeteEmail->execute();
                        if($requeteEmail->rowCount() == 0){
                        $requete = $dbh->prepare("INSERT INTO User(nom,prenom,mail,zipcode,password,IP) VALUES(:nom,:prenom,:mail,:zipcode,:password,:ip)");
                         $mdp= password_hash($password,PASSWORD_DEFAULT);
                         $requete->bindParam(':nom',$nom);
                         $requete->bindParam(':prenom',$fnom);
                         $requete->bindParam(':mail',$mail);
                         $requete->bindParam(':zipcode',$zipcode);
                         $requete->bindParam(':password',$mdp);
                         $requete->bindParam(':ip',$ip);
                         $requete->execute();
                         $_SESSION["error"] = "inscription réussi";
                        header("Location:index.php");
                      }else{
                        $_SESSION["error"] = "Le mail existe déja";
                        header("Location:index.php");
                      }
                  }
              }
          }
      }
    }
 }


function get_ip() {
	// IP si internet partagé
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	// IP derrière un proxy
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	// Sinon : IP normale
	else {
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}

