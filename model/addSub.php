<?php

//page de test
    session_start();
    require("../controller/database.php");
    
    
    $id_user = 92;
    $id_abonnement = 95;

    $db = new Database();
    $db->addSubcriber($id_user, $id_abonnement);

?>