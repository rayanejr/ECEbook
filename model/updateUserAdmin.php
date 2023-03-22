<?php 

session_start();

require("../controller/database.php");

if(!isset($_SESSION["admin"])){
    header("location: ../views/connexion.php");
    exit();
}

$db = new Database();

try {
    if(isset($_POST["submit"])){
        $user_id = $_GET["user_id"];
        $nomUser = $_POST["nom"] ?? '';
        $emailUser = $_POST["email"] ?? '';
        $prenomUser = $_POST["prenom"] ?? '';
        $naissanceUser = $_POST["naissance"] ?? '';
        $villeUser = $_POST["ville"] ?? '';
        $usernameUser = $_POST["username"] ?? '';
        $confirmerUser = $_POST["confirmer"] ?? '';
        $mdpUser = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT); // Hash the password
        $descriptionUser = $_POST["description"] ?? '';
    
        $db->updateUserById($user_id, $nomUser,$prenomUser,$naissanceUser,$villeUser,$usernameUser,$mdpUser,$descriptionUser,$emailUser,$confirmerUser);
    
        header("location: ../views/dashboard.php");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
