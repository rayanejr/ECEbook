<?php

//page de test
    session_start();
    require("../controller/database.php");
    
    
    $id_user1 = 92;
    $id_user2 = 93;

    $db = new Database();
    $db->addSubcriber($id_user1, $id_user2);

?>