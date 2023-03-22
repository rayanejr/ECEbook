<?php
session_start();
require("../controller/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user_id = $_SESSION["id_user"];
    $titre = $_POST['titre'];
    $pseudo = $_SESSION["pseudo"];
    $message = $_POST['message'];
    $date_creation=date('Y-m-d H:i:s');

    // save form data in the database
    $db = new Database();

    $db->insertPost($user_id, $titre, $pseudo, $message,$date_creation);

    header("location:../views/dashboard.php");
} else {
        // Display the errors
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    
}
?>
