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

    public function AddUser($nomU, $prenomU, $imageU, $naissanceU, $villeU, $promoU, $roleU, $usernameU, $emailU, $mdpU, $descriptionU)
    {
        try {
            $sql = "INSERT INTO `utilisateur` (`nom`, `prenom`, `image`, `ville`, `adressemail`, `mdp`, `roll`, `promo`, `datedenaissance`, `description`, `pseudo`)
                    VALUES (:nomU, :prenomU, :imageU, :villeU, :emailU, :mdpU, :roleU, :promoU, :naissanceU, :descriptionU, :usernameU)";
            $statement = self::$database->prepare($sql);
            $statement->bindParam(':nomU', $nomU);
            $statement->bindParam(':prenomU', $prenomU);
            $statement->bindParam(':imageU', $imageU);
            $statement->bindParam(':villeU', $villeU);
            $statement->bindParam(':emailU', $emailU);
            $statement->bindParam(':mdpU', $mdpU);
            $statement->bindParam(':roleU', $roleU);
            $statement->bindParam(':promoU', $promoU);
            $statement->bindParam(':naissanceU', $naissanceU);
            $statement->bindParam(':descriptionU', $descriptionU);
            $statement->bindParam(':usernameU', $usernameU);
            $statement->execute();
            echo "Welcome";
        } catch(PDOException $e) {
            echo "Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
            die();
        }
    }

}
