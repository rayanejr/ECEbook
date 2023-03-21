<?php
session_start();
session_destroy(); // destroy the session

header("Location: ../views/connexion.php"); // redirect to login page

?>
