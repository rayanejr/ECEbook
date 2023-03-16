<?php
require("../controller/database.php");
if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["image"]) && isset($_POST["naissance"]) && isset($_POST["ville"]) && isset($_POST["promo"]) && isset($_POST["role"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["motdepasse"]) && isset($_POST["description"])){
    $nomUser = $_POST["nom"];
    $prenomUser = $_POST["prenom"];
    $imageUser = $_POST["image"];
    $naissanceUser = $_POST["naissance"];
    $villeUser = $_POST["ville"];
    $promoUser = $_POST["promo"];
    $roleUser = $_POST["role"];
    $usernameUser = $_POST["username"];
    $emailUser = $_POST["email"];
    $mdpUser = $_POST["motdepasse"];
    $descriptionUser = $_POST["description"];

    $pers = new Database();
    $pers->AddUser($nomUser, $prenomUser, $imageUser, $naissanceUser, $villeUser, $promoUser, $roleUser, $usernameUser, $emailUser, $mdpUser, $descriptionUser);
    echo "Welcome";
    
}