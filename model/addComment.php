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
//$comments = $db->GetCommentByPostId($_GET['id_post']);
// sert à rien cette ligne ?

header("location: ../views/index2.php");
