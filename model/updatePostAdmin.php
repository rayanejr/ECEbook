<?php 

session_start();

require("../controller/database.php");

if(!isset($_SESSION["admin"])){
    header("location: ../views/connexion.php");
    exit();
}

$db = new Database();

try {
    if(isset($_POST["submit"])){
        $post_id = $_GET["post_id"];
        $titreP = $_POST["titre"] ?? '';
        $messageP = $_POST["message"] ?? '';
       
        $imagePost = $_FILES['image']['name'];
        $filetmpname = $_FILES['image']['tmp_name'];

        $folder = '../uploads/';
        move_uploaded_file($filetmpname, $folder . $imagePost);

        $db->updatePostById($post_id,$titreP,$messageP,$imagePost);
    
        header("location: ../views/dashboard.php");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
