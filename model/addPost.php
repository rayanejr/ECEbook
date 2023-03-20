<?php
session_start();
require("../controller/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user_id = $_SESSION["id_user"];
    $titre = $_POST['titre'];
    $pseudo = $_SESSION["nom"];
    $message = $_POST['message'];


    // save form data in the database
    $db = new Database();
    $db->insertPost($user_id, $titre, $pseudo, $message);

    header("location:../views/index2.php");
}
?>
