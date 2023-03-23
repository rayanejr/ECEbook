<?php
/*
error_reporting(E_ERROR | E_PARSE);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}*/

require("../controller/database.php");
    
    
    $id_user1 = $_GET['id_user'];
    $id_user2 = $_GET['id_abonne'];

    
    $db = new Database();
    $db->addSubcriber($id_user1, $id_user2);

    echo "<script>alert('vous avez accépter la demande d'abonnement, vous pouvez fermer cette page');</script>";

?>

