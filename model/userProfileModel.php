<?php 

require("../controller/database.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.php");
}



$db = new Database();

$userId = intval($_GET["user_id"]);

$user_profile = $db->GetUserById($_GET["user_id"]);




