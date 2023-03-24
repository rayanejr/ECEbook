<?php
error_reporting(E_ERROR | E_PARSE);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require("../controller/database.php");
require_once("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("../vendor/phpmailer/phpmailer/src/SMTP.php");
require_once("../vendor/phpmailer/phpmailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';


$id_abonné = $_GET['id_abonné'];

$db = new Database();
$abonné = $db->GetUserById($id_abonné);
$email =$abonné["adressemail"];
$id_user = $_SESSION['id_user'];


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
$mail->Username = "sami.abdulhalim.pro@gmail.com";
//Set gmail password
$mail->Password = "cvecdgcdfxeaupbd";
//Email subject
$mail->Subject = 'réinitialisation de votre mot de passe EceBook';

//Set sender email
$mail->setFrom('sami.abdulhalim.pro@gmail.com');
//Enable HTML
$mail->isHTML(true);
//Attachment

//Email body
$mail->Body    = "Bonjour $email,<br><br>
Veuillez cliquer sur le lien suivant pour accépter la demande d'abonnement de :<br>
<a href='http://localhost/ECEbook/model/addSub.php?id_abonné=$id_abonne&id_user=$id_user  '>http://localhost/ECEbook/model/addSub.php?id_abonné=$id_abonne&id_user=$id_user </a><br><br>
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

header("location: ../views/index2.php");
?>