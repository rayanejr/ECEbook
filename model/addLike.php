<?php 


require_once("../controller/database.php");

$id_post = $_GET['id_post'];
    $userID = $_SESSION['id_user'];
if(isset($_POST(["like"]))){
	
	$db = new Database();
    $db->addLike($_SESSION["id_user"], $_GET["id_post"]);
    header("location:../views/connexion.php");

}



?>
