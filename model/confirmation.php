<?php
require_once("../controller/database.php");

if (isset($_GET['email']) && isset($_GET['code'])) {

    $email = $_GET['email'];
    $code = $_GET['code'];

    $db = new Database();

    $user = $db->GetUserByEmailAndCode($email, $code);

    if ($user) {
        if (isset($user['confirmer']) && $user['confirmer'] == 0) {

            $db->ConfirmUser($email);
            echo "Votre compte est maintenant confirmé. Vous pouvez vous connecter à ECEbook !";
            
            exit();
        } else {
            echo "Votre compte est déjà confirmé.";
        }
    } else {
        echo "Le code de confirmation est incorrect.";
    }
} else {
    echo "Paramètres manquants.";
}
?>
