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
    $code = $_GET['code'];


    $db = new Database();
    $receveur = $db->GetUserById($id_user2);

    if($receveur['code_confirmation']== $code)
    {
        echo "<script>alert('vous avez accépter la demande d'abonnement, vous pouvez fermer cette page');</script>";
        $db->addSubcriber($id_user1, $id_user2);
    }
    else
    {
        echo "<script>alert('mauvais code de confirmation, vous pouvez fermer cette page');</script>";
    }

    //on remet le code à 0 à la fin de chaque utilisation 
    $db->updateVericiationCodeByEmail($receveur['adressemail'],"");


?>

