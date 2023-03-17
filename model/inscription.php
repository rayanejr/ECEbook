<?php
require_once("../controller/database.php");

if(isset($_POST["submit"])){
    
    $errors = [];

    $nomUser = $_POST["nom"] ?? '';
    $prenomUser = $_POST["prenom"] ?? '';
    $imageUser = $_POST["image"] ?? '';
    $naissanceUser = $_POST["naissance"] ?? '';
    $villeUser = $_POST["ville"] ?? '';
    $promoUser = $_POST["promo"] ?? '';
  /*   $roleUser = $_POST["role"] ?? ''; */
    $usernameUser = $_POST["username"] ?? '';
    $emailUser = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL);
    $mdpUser = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT); // Hash the password
    $descriptionUser = $_POST["description"] ?? '';

    // Check if email is valid and from a valid domain
    if (!$emailUser) {
        $errors[] = "L'adresse e-mail n'est pas valide";
    } else {
        $validDomains = ['edu.ece.fr', 'omnes.intervenant.fr', 'admin.fr'];
        $domain = substr(strrchr($emailUser, "@"), 1);
        if (!in_array($domain, $validDomains)) {
            $errors[] = "L'adresse e-mail doit être de domaine edu.ece.fr, omnes.intervenant.fr ou admin.fr";
        }
        elseif($domain === "edu.ece.fr"){
            $roleUser = "etudiant";
        }
        elseif($domain === "omnes.intervenant.fr"){
            $roleUser = "professeur";
        }
        elseif($domain === "admin.fr"){
            $roleUser = "admin";
        }
    }


 

    if(empty($emailUser)){
        echo "<style>.promo {display:none}</style>";
    }
    else{
        echo "<style>.promo {display:block}</style>";
    }


    // Check if there are any errors
    if (count($errors) == 0) {
        $db = new Database();
        $db->AddUser($nomUser, $prenomUser, $imageUser, $naissanceUser, $villeUser, $promoUser, $roleUser, $usernameUser, $emailUser, $mdpUser, $descriptionUser);

        if($domain === "admin.fr" ) {
            header("location: ../views/dashborad.php");
            exit();
        } else {
            header("location: ../views/connexion.html");
            exit();
        }
    } else {
        // Display the errors
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }
}
?>
