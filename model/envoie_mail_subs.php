<?php
error_reporting(E_ERROR | E_PARSE);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require("../controller/database.php");
require("../model/navbar.php");

require_once("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("../vendor/phpmailer/phpmailer/src/SMTP.php");
require_once("../vendor/phpmailer/phpmailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';



$id_abonne = $_GET['id_abonné'];

$db = new Database();
$abonné = $db->GetUserById($id_abonne);
$email = htmlspecialchars($abonné["adressemail"]);
$id_user = $_SESSION['id_user'];
$mailenvoyeur = htmlspecialchars($_SESSION["email"]);

if($id_abonne == $id_user)
{
    echo "vous ne pouvez pas vous abonner à vous même";
    sleep(1);
    header("location: ../views/index2.php");
}

$verification_code = bin2hex(random_bytes(16)); // Génère 16 octets de données aléatoires et les convertit en une chaîne hexadécimale
$db->updateVericiationCodeByEmail($email,$verification_code);


$mail = new PHPMailer(true);

$mail = new PHPMailer();
//Set mailer to use smtp
$mail->isSMTP();
//Define smtp host
$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
$mail->SMTPSecure = "tls";
//Port to connect smtp
$mail->Port = "587";
//Set gmail username
$mail->Username = "ecebookprojet@gmail.com";
//Set gmail password
$mail->Password = "gxzptfdowslnbout";
//Email subject
$mail->Subject = "demande d'abonnement";

//Set sender email
$mail->setFrom('ecebookprojet@gmail.com');
//Enable HTML
$mail->isHTML(true);
//Attachment

//Email body
$mail->Body    = "Bonjour $email,<br><br>
Veuillez cliquer sur le lien suivant pour accépter la demande d'abonnement de $mailenvoyeur,<br>
<a href='http://localhost/ECEbook/model/addSub.php?id_abonne=$id_abonne&id_user=$id_user&code=$verification_code  '>http://localhost/ECEbook/model/addSub.php?id_abonne=$id_abonne&id_user=$id_user&code=$verification_code </a><br><br>
Cordialement,<br>
L'équipe EceBook";
//Add recipient
$mail->addAddress($email);
//Finally send email
if ( $mail->send() ) {
    echo "le mail a été envoyé a $email";
}else{
    echo "Message could not be sent. Mailer Error: $mail->ErrorInfo";
    var_dump($email);
    var_dump($verification_code );
    var_dump($mail->send());
}
//Closing smtp connection
$mail->smtpClose();

?>

<script>
		// Attendre une seconde avant de rediriger l'utilisateur
		setTimeout(function() {
			window.location.href = "../views/index2.php";
		}, 2000);
</script>