<?php
session_start();

if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require("../controller/database.php");

$id_post = $_GET['id_post'];
$id_user = $_SESSION['id_user'];
$commentaire = $_POST['comment'];

$db = new Database();
$db->AddComment($id_user, $id_post, $commentaire);

header("location: ../views/index2.php");
