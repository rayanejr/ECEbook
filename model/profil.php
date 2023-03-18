<?php
require('../controller/database.php');
session_start();
if(!isset($_SESSION["id_user"])){
    header("Location:../views/connexion.html");
    exit();
}else{
$db=new Database();
$user= $db->GetUserById($_SESSION['id_user']);
}
?>