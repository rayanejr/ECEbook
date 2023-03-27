<?php

require("../controller/database.php");
    
    
    $id_user1 = intval($_GET["id_user"]);
    $id_user2 = intval($_GET['id_abonne']);
    $code = $_GET['code'];

    var_dump($id_user1);
    var_dump($id_user2);
    $db = new Database();
    $receveur = $db->GetUserById($id_user2);

    if($receveur['code_confirmation']== $code)
    {
        echo "<script>alert('vous avez accépter la demande d'abonnement, vous pouvez fermer cette page');</script>";
        $db->addSubcriber($id_user1, $id_user2);
    }
    else
    {
        echo "<script>alert('mauvais code de confirmation, vous pouvez fermer cette page');</script>";
    }

    //on remet le code à 0 à la fin de chaque utilisation 
    $db->updateVericiationCodeByEmail($receveur['adressemail'],"");

?>
<script>
		// Attendre une seconde avant de rediriger l'utilisateur
		setTimeout(function() {
			window.location.href = "../views/connexion.php";
		}, 2000);
</script>

