<?php
/*quand on clique sur envoyé le commentaire ca renvoie vers ici
et ca le mets dans la base de données des commentaires 
puis ca renvoie vers la page d'acceuil, avec l'affichage des commentaire updaté*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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

?>

