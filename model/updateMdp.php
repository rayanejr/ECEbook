<?php
require("../controller/Database.php");


require_once("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("../vendor/phpmailer/phpmailer/src/SMTP.php");
require_once("../vendor/phpmailer/phpmailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require '../vendor/autoload.php';


if(isset($_POST["submit"])){


    $email = htmlspecialchars($_POST["email"]);
    $db = new Database();
    $user = $db->GetUserByEmail($email); // ça na pas de sens, on demande un mail pour après verifier que le mail est bien celui de l'utilisateur ??
    if($user){

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
    $mail->Subject = 'Reinitialisation de votre mot de passe EceBook';
    
    //Set sender email
        $mail->setFrom('ecebookprojet@gmail.com');
    //Enable HTML
        $mail->isHTML(true);
    //Attachment
        
    //Email body
    $mail->Body    = "Bonjour $email,<br><br>
    Veuillez cliquer sur le lien suivant pour confirmer la réinitialisation de votre mot de passe EceBook:<br>
    <a href='http://localhost/ECEbook/views/resetpassword.php?email=$email&code=$verification_code '>http://localhost/ECEbook/views/resetpassword.php?email=$email&code=$verification_code </a><br><br>
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
    

        


     /*    header("location:../views/resetpassword.php?email=" . urlencode($email)); */
    };

}

