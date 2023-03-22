<?php 


require("../controller/database.php");
session_start();


if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.php");
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
    $descriptionUser = $_POST["description"] ?? '';
    $emailUser = $_POST["email"] ?? '';
    $confirmerUser = $_POST["confirmer"] ?? '';
    $imageUser = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];
    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $imageUser);
    $db->updateUserById($user_id, $nomUser,$prenomUser,$naissanceUser,$villeUser,$usernameUser,$descriptionUser,$emailUser,$confirmerUser,$imageUser);

    header("location: ../views/updateUser.php");




}



?>