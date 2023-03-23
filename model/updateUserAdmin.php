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
        $user_id = $_GET["user_id"];
        $nomUser = $_POST["nom"] ?? '';
        $emailUser = $_POST["email"] ?? '';
        $prenomUser = $_POST["prenom"] ?? '';
        $naissanceUser = $_POST["naissance"] ?? '';
        $villeUser = $_POST["ville"] ?? '';

        $promo = $_POST["choixPromo"] ?? '';
        if (is_array($promo)) {
        $promoUser = implode(",", $promo);
        } else
         {$promoUser = $promo;
         }

        $usernameUser = $_POST["username"] ?? '';
        $promoUser = $_POST["choixPromo"] ?? '';
        $confirmerUser = $_POST["confirmer"] ?? '';
        $descriptionUser = $_POST["description"] ?? '';
        $imageUser = $_FILES['image']['name'];
        $filetmpname = $_FILES['image']['tmp_name'];

        $folder = '../uploads/';
        move_uploaded_file($filetmpname, $folder . $imageUser);

        $db->updateUserById($user_id, $nomUser,$prenomUser,$naissanceUser,$villeUser,$usernameUser,$descriptionUser,$emailUser,$confirmerUser,$promoUser,$imageUser,$promoUser);
    
        header("location: ../views/dashboard.php");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
