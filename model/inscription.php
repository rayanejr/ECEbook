<?php
require_once("../controller/database.php");

if(isset($_POST["submit"])){

    $errors = [];

    $nomUser = $_POST["nom"] ?? '';
    $prenomUser = $_POST["prenom"] ?? '';
    $naissanceUser = $_POST["naissance"] ?? '';
    $villeUser = $_POST["ville"] ?? '';
    $promoUser = $_POST["promo"] ?? '';
    $usernameUser = $_POST["username"] ?? '';
    $emailUser = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL);
    $mdpUser = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT); // Hash the password
    $descriptionUser = $_POST["description"] ?? '';
    $imageUser = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];

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

    $db = new Database();
    
    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $imageUser);

    $db->AddUser($nomUser, $prenomUser, $naissanceUser, $villeUser, $promoUser, $roleUser, $usernameUser, $emailUser, $mdpUser, $descriptionUser, $imageUser);

    // Check if there are any errors
    if (count($errors) == 0) {

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
