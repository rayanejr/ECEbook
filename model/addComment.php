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

if(isset($_POST['submit'])) {

require("../controller/database.php");


$id_post = $_GET['id_post'];
$id_user = $_SESSION['id_user'];
$commentaire = $_POST['comment'];

$db = new Database();
$db->AddComment($id_user, $id_post, $commentaire);
$comments = $db->GetCommentByPostId($_GET['id_post']);

}

header("location: ../views/index2.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

