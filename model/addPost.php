<?php
session_start();
require("../controller/database.php");

if(isset($_POST["submit"])){


    try{
    $user_id = $_SESSION["id_user"];
    $titre = $_POST['titre'];
    $nom = $_SESSION["nom"];
    $message = $_POST['message'];
    $date_creation = date('Y-m-d H:i:s');
    $imagePost = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];
   
    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $imagePost);
        
        if(strlen($message) > 500){
            echo "<script>alert('Erreur : le message dépasse la limite de 500 caractères.');</script>";
            header("location:../views/index2.php"); 
            exit();
        }

   // save form data in the database
   $db = new Database();
   $db->insertPost($user_id, $titre, $nom, $message, $imagePost, $date_creation);
   header("location:../views/index2.php"); 
    }catch(PDOException $e) {
        echo "Error adding post: " . $e->getMessage();
        die();
    }


}
?>
