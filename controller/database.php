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

    public function AddUser($nomU, $prenomU, $naissanceU, $villeU, $promoU, $roleU, $usernameU, $emailU, $mdpU, $descriptionU, $imageU)
    {
        try {
            $sql = "INSERT INTO `utilisateur` (`nom`, `prenom`, `datedenaissance`, `ville`, `promo`, `roll`, `pseudo`, `adressemail`, `mdp`, `description`, `image`)
                    VALUES (:nomU, :prenomU, :naissanceU, :villeU, :promoU, :roleU, :usernameU, :emailU, :mdpU, :descriptionU, :imageU)";
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








    

}