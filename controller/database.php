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
        self::$database = new PDO(self::$dns, self::$user, self::$password);
    }

    public function AddUser($nomU, $prenomU, $imageU, $naissanceU, $villeU, $promoU, $roleU, $usernameU, $emailU, $mdpU, $descriptionU)
    {
        $sql = "INSERT INTO `utilisateur` (`nom`, `prenom`, `image`, `ville`, `adressemail`, `mdp`, `roll`, `promo`, `datedenaissance`, `description`, `pseudo`)
            VALUES (:nomU, :prenomU, :imageU, :naissanceU, :villeU, :promoU, :roleU, :usernameU, :emailU, :mdpU, :descriptionU)";
        $statement = self::$database->prepare($sql);
        $statement->execute(array(":nomU" => ))
    }

}