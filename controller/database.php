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
    $query = "SELECT * FROM utilisateur WHERE adressemail=:email AND code_confirmation=:code AND confirmer=0";
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
    $query = "UPDATE utilisateur SET confirmer = 1 WHERE id_user =:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $user_id);
    $statement->execute();
}


public function GetUserById($user_id) {
    $database = self::getInstance();
    $query = "SELECT * FROM utilisateur WHERE id_user = ?";
    $statement = $database->prepare($query);
    $statement->bindParam(1, $user_id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

public function deleteUserById($user_id) {
    $database = self::getInstance();
    $query = "DELETE FROM utilisateur WHERE id_user=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $user_id);
    $statement->execute();
    return $statement->fetch();
}

public function updateUserById($user_id, $nomU, $prenomU, $naissanceU, $villeU, $promoU, $roleU, $usernameU, $emailU, $mdpU, $descriptionU, $imageU) {
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET nom=:nomU, prenom=:prenomU, datedenaissance=:naissanceU, ville=:villeU, promo=:promoU, roll=:roleU, pseudo=:usernameU, adressemail=:emailU, mdp=:mdpU, description=:descriptionU, image=:imageU WHERE id_user=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $user_id);
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
    return $statement->fetch();
}

public function AddPost($id_user, $titre, $description, $image, $date)
{
    try {
        $sql = "INSERT INTO `post` (`id_user`, `titre`, `description`, `image`, `date`)
        VALUES (:id_user, :titre, :description, :image, :date)";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':date', $date);
        $statement->execute();
        echo "Welcome";
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
        die();
    }
}

public function GetPostById($id_post) {
    $database = self::getInstance();
    $query = "SELECT * FROM post WHERE id_post=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_post);
    $statement->execute();
    return $statement->fetch();
}

public function GetPostByUserId($id_user) {
    $database = self::getInstance();
    $query = "SELECT * FROM post WHERE id_user=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_user);
    $statement->execute();
    return $statement->fetchAll();
}

public function GetPost() {
    $database = self::getInstance();
    $query = "SELECT * FROM post";
    $statement = $database->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}


public function deletePostById($id_post) {
    $database = self::getInstance();
    $query = "DELETE FROM post WHERE id_post=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_post);
    $statement->execute();
    return $statement->fetch();
}

public function updatePostById($id_post, $titre, $description, $image) {
    $database = self::getInstance();
    $query = "UPDATE post SET titre=:titre, description=:description, image=:image WHERE id_post=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_post);
    $statement->bindParam(':titre', $titre);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':image', $image);
    $statement->execute();
    return $statement->fetch();
}

public function AddComment($id_user, $id_post, $commentaire, $date)
{
    try {
        $sql = "INSERT INTO `commentaire` (`id_user`, `id_post`, `commentaire`, `date`)
        VALUES (:id_user, :id_post, :commentaire, :date)";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':id_post', $id_post);
        $statement->bindParam(':commentaire', $commentaire);
        $statement->bindParam(':date', $date);
        $statement->execute();
        echo "Welcome";
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
        die();
    }
}

public function GetCommentById($id_comment) {
    $database = self::getInstance();
    $query = "SELECT * FROM commentaire WHERE id_comment=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_comment);
    $statement->execute();
    return $statement->fetch();
}

public function GetCommentByUserId($id_user) {
    $database = self::getInstance();
    $query = "SELECT * FROM commentaire WHERE id_user=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_user);
    $statement->execute();
    return $statement->fetchAll();
}

public function GetCommentByPostId($id_post) {
    $database = self::getInstance();
    $query = "SELECT * FROM commentaire WHERE id_post=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_post);
    $statement->execute();
    return $statement->fetchAll();
}

public function GetComment() {
    $database = self::getInstance();
    $query = "SELECT * FROM commentaire";
    $statement = $database->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

public function deleteCommentById($id_comment) {
    $database = self::getInstance();
    $query = "DELETE FROM commentaire WHERE id_comment=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_comment);
    $statement->execute();
    return $statement->fetch();
}

public function updateCommentById($id_comment, $commentaire) {
    $database = self::getInstance();
    $query = "UPDATE commentaire SET commentaire=:commentaire WHERE id_comment=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_comment);
    $statement->bindParam(':commentaire', $commentaire);
    $statement->execute();
    return $statement->fetch();
}

public function AddLike($id_user, $id_post)
{
    try {
        $sql = "INSERT INTO `like` (`id_user`, `id_post`)
        VALUES (:id_user, :id_post)";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':id_post', $id_post);
        $statement->execute();
        echo "Welcome";
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
        die();
    }
}

public function GetLikeById($id_like) {
    $database = self::getInstance();
    $query = "SELECT * FROM like WHERE id_like=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_like);
    $statement->execute();
    return $statement->fetch();
}

public function GetLikeByUserId($id_user) {
    $database = self::getInstance();
    $query = "SELECT * FROM like WHERE id_user=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_user);
    $statement->execute();
    return $statement->fetchAll();

}

public function GetLikeByPostId($id_post) {
    $database = self::getInstance();
    $query = "SELECT * FROM like WHERE id_post=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_post);
    $statement->execute();
    return $statement->fetchAll();
}

public function GetLike() {
    $database = self::getInstance();
    $query = "SELECT * FROM like";
    $statement = $database->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}












    

}