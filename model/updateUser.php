<?php 


require("../controller/database.php");
session_start();


if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
    exit();
}



$db = new Database();
$user = $db->GetUserById($_SESSION["id_user"]);



if(isset($_POST["submit"])){

    $user_id = $_SESSION["id_user"];
    $nomUser = $_POST["nom"] ?? '';
    $prenomUser = $_POST["prenom"] ?? '';
    $naissanceUser = $_POST["naissance"] ?? '';
    $villeUser = $_POST["ville"] ?? '';
    $usernameUser = $_POST["username"] ?? '';
    $emailUser = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL);
    $mdpUser = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT); // Hash the password
    $descriptionUser = $_POST["description"] ?? '';


    $db->updateUserById($user_id, $nomUser,$prenomUser,$naissanceUser,$villeUser,$usernameUser,$emailUser,$mdpUser,$descriptionUser);

    header("location: ../views/updateUser.php");




}



?>