<?php

class Database{

    private static $dns;
    private static $user;
    private static $password;
    private static $database;

    public function __construct()
    {
        self::$dns = "mysql:host=localhost;dbname=ecebook;port=3306"; // À changer selon vos configurations
        self::$user = "root"; // À changer selon vos configurations
        self::$password = ""; // À changer selon vos configurations
        try {
            self::$database = new PDO(self::$dns, self::$user, self::$password);
            self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erreur de connexion à la base de données: " . $e->getMessage();
            die();
        }
    }




    public static function getInstance() {
        if (!self::$database) {
            self::$dns = "mysql:host=localhost;dbname=ecebook;port=3306"; // À changer selon vos configurations
            self::$user = "root"; // À changer selon vos configurations
            self::$password = ""; // À changer selon vos configurations
            try {
                self::$database = new PDO(self::$dns, self::$user, self::$password);
                self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erreur de connexion à la base de données: " . $e->getMessage();
                die();
            }
        }
        return self::$database;
    }




    public function AddUser($nomU, $prenomU, $naissanceU, $villeU, $promoU, $roleU, $usernameU, $emailU, $mdpU, $descriptionU, $imageU,$code_confirmation)
    {


        try {
            $sql = "INSERT INTO `utilisateur` (`nom`, `prenom`, `datedenaissance`, `ville`, `promo`, `roll`, `pseudo`, `adressemail`, `mdp`, `description`, `image`, `code_confirmation`)
            VALUES (:nomU, :prenomU, :naissanceU, :villeU, :promoU, :roleU, :usernameU, :emailU, :mdpU, :descriptionU, :imageU, :code_confirmation)";
    $statement = self::$database->prepare($sql);
    $statement->bindParam(':nomU', $nomU);
    $statement->bindParam(':prenomU', $prenomU);
    $statement->bindParam(':naissanceU', $naissanceU);
    $statement->bindParam(':villeU', $villeU);
    $statement->bindParam(':promoU', $promoU);
    $statement->bindParam(':roleU', $roleU);
    $statement->bindParam(':usernameU', $usernameU);
    $statement->bindParam(':emailU', $emailU);
    $statement->bindParam(':mdpU', $mdpU);
    $statement->bindParam(':descriptionU', $descriptionU);
    $statement->bindParam(':imageU', $imageU);
    $statement->bindParam(':code_confirmation', $code_confirmation);
            $statement->execute();
            echo "Welcome";
        } catch(PDOException $e) {
            echo "Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
            die();
        }
    }
    
    



    public function Login($email, $password)
{
    try {
        $sql = "SELECT * FROM `utilisateur` WHERE `adressemail` = :email";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch(PDOException $e) {
        echo "Erreur lors de la connexion: " . $e->getMessage();
        die();
    }
}




public function GetUserByEmailAndCode($email, $code) {
    $database = self::getInstance();
    $query = "SELECT * FROM utilisateur WHERE adressemail=:email AND code_confirmation=:code AND confimrer=0";
    $statement = $database->prepare($query);
    $statement->bindParam(":email", $email);
    $statement->bindParam(":code", $code);
    $statement->execute();
    return $statement->fetch();
}



public function GetUserByCode($code) {
    $database = self::getInstance();
    $query = "SELECT * FROM utilisateur WHERE code_confirmation=:code";
    $statement = $database->prepare($query);
    $statement->bindParam(":code", $code);
    $statement->execute();
    return $statement->fetch();
}




public function ConfirmUser($user_id) {
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET confimrer = 1 WHERE id_user =:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $user_id);
    $statement->execute();
}


public function GetUserById($id) {
    $database = self::getInstance();
    $query = "SELECT * FROM utilisateur WHERE id_user=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id);
    $statement->execute();
    $user=$statement->fetch();
    return $user;

}



    

}