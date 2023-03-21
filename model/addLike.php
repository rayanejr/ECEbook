<?php 


require_once("../controller/database.php");


   
        $id_post = intval($_GET['post_id']) ;
        $userID = intval($_GET["user_id"]) ;
        
        var_dump($id_post);
        var_dump($userID);
	$db = new Database();
    $db->addLike($id_post,$userID);
   
    header("location:../views/index2.php"); 





?>
