<?php

require("../controller/database.php");
session_start();

if(!isset($_SESSION["admin"])){
    header("location: ../views/connexion.php");
    exit();
}

$db = new Database();


    $db->deleteUserById($_GET["user_id"]);
   
    header("location: ../views/dashborad.php");
    exit();
    

?>
