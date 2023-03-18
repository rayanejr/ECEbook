<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../controller/database.php");
if(!isset($_SESSION["id_user"])){
    header("Location:../views/connexion.html");
    exit();
} else {
    $db = new Database();
    $user_id = $_SESSION['id_user'];
    $user = $db->GetUserById($_SESSION["id_user"]);
}
?>