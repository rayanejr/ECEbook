<?php

session_start();
if(!isset($_SESSION["user_id"])){
    header("Location:../views/connexion.html");
}
$db=new Database();
$db->GetUserById($_SESSION['user_id']);
?>