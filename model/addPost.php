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
    if(isset($_POST['publique']) && $_POST['publique'] == '1'){
        $publique = '1';
    } else {
        $publique = '0';
    }

    //on detecter les identificatio dans le poste 
    //et stock les pseudo dans un tableau
    $pattern = '/#(\w+)/';
    $matches = array();
    preg_match_all($pattern, $message, $matches);
    $names = $matches[1];

    // afficher les noms trouvés
   
    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $imagePost);
        
        if(strlen($message) > 500){
            echo '<div class="alert alert-danger" role="alert">
            <script>alert("Erreur : le message dépasse la limite de 500 caractères.");</script>
          </div>
            ';
            header("location:../views/index2.php"); 
            exit();
        }

    // save form data in the database
    $db = new Database();
    $db->insertPost($user_id, $titre, $nom, $message, $imagePost, $publique, $date_creation);

    if(empty($names)!=1)
    {
        $_SESSION['names'] = $names;
        $_SESSION['message_post'] = $message;
        $_SESSION['date_post'] = $date_creation;
        header("location:../model/envoie_mail_identification.php");
    }

    }catch(PDOException $e) {
        echo "Error adding post: " . $e->getMessage();
        die();
    }


}
?>
