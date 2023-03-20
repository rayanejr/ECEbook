<?php
    session_start();
    require("../controller/database.php");
    
    $id_user = 94;
    $id_abonnement = 93;

    $db = new Database();
    $db->addSubcriber($id_user, $id_abonnement);

?>