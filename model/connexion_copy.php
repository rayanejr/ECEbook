<?php
error_reporting(E_ERROR | E_PARSE);

session_start();
require_once("../controller/database.php");

if(1){
    /*$email = htmlspecialchars($_POST["mail"] ?? '');
    $password = htmlspecialchars($_POST["password"] ?? '');*/
    
    try {
        /*$db = new Database();
        $user = $db->Login($email, $password);*/
        if(1) { // check if user exists and password is correct
           
            if(1){

                $_SESSION["id_user"] = 1;
                $_SESSION['nom'] = "chatel";
                $_SESSION['prenom'] = "andreas";
                $_SESSION['email'] = "andreas.chatel@edu.ece.fr";
                $_SESSION['role'] = "admin";
                $_SESSION['promo'] = "BACH2";
                $_SESSION['image'] = "bonk.jpg";
                $_SESSION['description'] = "compte craqué pour test";
                $_SESSION['logged_in'] = true;

                header("location: ../views/profile.php");
            }
            
        } 
    } catch(PDOException $e) {
        echo "Erreur lors de la connexion: " . $e->getMessage();
        die();
    }
}
?>
