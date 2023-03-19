<?php
require_once("../controller/database.php");

require_once("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("../vendor/phpmailer/phpmailer/src/SMTP.php");
require_once("../vendor/phpmailer/phpmailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require '../vendor/autoload.php';

if(isset($_POST["submit"])){


    $newpassword =  password_hash($_POST["motdepasse"], PASSWORD_DEFAULT); 
    $db = new Database();
    
    $email = $_POST["email"] ?? '';
    $db->UpdatePassword($email, $newpassword);


   

    header("Location: ../views/connexion.php");
    exit();

}

?>