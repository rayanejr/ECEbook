<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

$_POST['id_post'] = $_GET['id_post'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulaire ajout de commentaire </title>
</head>
<body>
	<h1>Ajouter un commentaire</h1>
	<form action="../model/addComment.php?id_post=<?php echo $_GET['id_post']?>" method="post">
		<label for="comment">Commentaire :</label><br>
		<textarea id="comment" name="comment" rows="5" cols="50"></textarea><br><br>
		<input type="submit" value="Envoyer">
	</form>
</body>
</html>


