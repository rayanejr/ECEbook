<?php
session_start();
require("../controller/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user_id = $_SESSION["id_user"];
    $titre = $_POST['titre'];
    $pseudo = $_SESSION["pseudo"];
    $message = $_POST['message'];
    $date_creation=date('Y-m-d H:i:s');
    $imagePost = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];
   
    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $imagePost);
    if(strlen($message) > 500){
        echo "<script>alert('Erreur : le message dépasse la limite de 500 caractères.');</script>";
        header("location:../views/dashboard.php"); 
        exit();
    }

    // save form data in the database
    $db = new Database();

    $db->insertPost($user_id, $titre, $pseudo, $message,$imagePost,$date_creation);

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
