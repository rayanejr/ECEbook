<?php
require("../controller/database.php");

if(isset($_POST["submit"])){
    
    $errors = [];

    $nomUser = htmlspecialchars($_POST["nom"] ?? '');
    $prenomUser = htmlspecialchars($_POST["prenom"] ?? '');
    $imageUser = htmlspecialchars($_POST["image"] ?? '');
    $naissanceUser = htmlspecialchars($_POST["naissance"] ?? '');
    $villeUser = htmlspecialchars($_POST["ville"] ?? '');
    $promoUser = htmlspecialchars($_POST["promo"] ?? '');
    $roleUser = htmlspecialchars($_POST["role"] ?? '');
    $usernameUser = htmlspecialchars($_POST["username"] ?? '');
    $emailUser = filter_var($_POST["email"] ?? '', FILTER_SANITIZE_EMAIL);
    $mdpUser = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT); // Hash the password
    $descriptionUser = htmlspecialchars($_POST["description"] ?? '');

 // Vérifier que l'adresse e-mail est issue d'un domaine  ece valide
    $validDomains = ['edu.ece.fr', 'omnes.intervenant.fr'];
    $domain = substr(strrchr($emailUser, "@"), 1);
    if (!in_array($domain, $validDomains)) {
        $errors[] = "L'adresse e-mail doit être de domaine edu.ece.fr ou omnes.intervenant.fr";
    }

       // Vérifier que l'adresse e-mail est valide
    if (!filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse e-mail n'est pas valide";
    }

    if (count($errors) == 0) {
        $pers = new Database();
        $pers->AddUser($nomUser, $prenomUser, $imageUser, $naissanceUser, $villeUser, $promoUser, $roleUser, $usernameUser, $emailUser, $mdpUser, $descriptionUser);
        echo "Welcome";
        header("location: ../views/connexion.html");
    } else {
        // Afficher les erreurs
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }
}
