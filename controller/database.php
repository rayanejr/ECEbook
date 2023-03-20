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




public function confirmUser($email) {
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET confirmer = 1 WHERE adressemail = :email";
    $statement = $database->prepare($query);
    $statement->bindParam(":email", $email, PDO::PARAM_INT);
    
    try {
        $statement->execute();
        $affectedRows = $statement->rowCount();
        
        if ($affectedRows == 0) {
            throw new Exception("Invalid email  provided.");
        }
        
        return true;
    } catch (PDOException $e) {
        // Handle database errors
        error_log("Database error: " . $e->getMessage());
        return false;
    } catch (Exception $e) {
        // Handle other errors
        error_log("Error: " . $e->getMessage());
        return false;
    }
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

public function GetUserByEmail($email) {
    $database = self::getInstance();
    $query = "SELECT * FROM utilisateur WHERE adressemail = ?";
    $statement = $database->prepare($query);
    $statement->bindParam(1, $email, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}


public function deleteUserById($user_id) {
    $database = self::getInstance();
    $query = "DELETE FROM utilisateur WHERE id_user=?";
    $statement = $database->prepare($query);
    $statement->bindParam(1, $user_id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}


public function AddConfirmationCode($email, $confirmation_code){
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET code_confirmation=? WHERE adressemail=?";
    $statement = $database->prepare($query);
    $statement->execute([$confirmation_code, $email]);
    return $statement->rowCount() > 0;
}

public function VerifyConfirmationCode($email, $code){
    $database = self::getInstance();
    $query = "SELECT * FROM utilisateur WHERE adressemail=? AND code_confirmation=?";
    $statement = $database->prepare($query);
    $statement->execute([$email, $code]);
    return $statement->rowCount() > 0;
}

public function updateVericiationCodeByEmail($email,$verification_code){
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET code_confirmation=? WHERE adressemail=?";
    $statement = $database->prepare($query);
    $statement->execute([$verification_code, $email]);
    return $statement->rowCount() > 0;
}
public function updateUserById($user_id, $nomU, $prenomU, $naissanceU, $villeU,  $usernameU,$mdpU, $descriptionU) {
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET nom=?, prenom=?, datedenaissance=?, ville=?,  pseudo=?, mdp=?, description=?  WHERE id_user=?";
    $statement = $database->prepare($query);
    $statement->execute([$nomU, $prenomU, $naissanceU, $villeU, $usernameU, $mdpU, $descriptionU, $user_id]);
    return $statement->rowCount() > 0;
}
public function UpdatePassword($email, $mdpU){
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET mdp=? WHERE adressemail=?";
    $statement = $database->prepare($query);
    $statement->execute([$mdpU, $email]);
    return $statement->rowCount() > 0;
}

public function updateMdpByEmail($email,$mdpU) {
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET  mdp=?WHERE adressemail=?";
    $statement = $database->prepare($query);
    $statement->execute([ $mdpU, $email]);
    return $statement->rowCount() > 0;
}





public function AddPost($id_user, $titre, $message, $image, $date)
{
    try {
        $sql = "INSERT INTO `post` (`id_user`, `titre`, `message`, `image`, `date`)
        VALUES (:id_user, :titre, :message, :image, :date)";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':message', $message);
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

function getAllPosts() {
    $pdo = self::getInstance();
    $sql = "SELECT * FROM post ORDER BY date DESC";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function addOrUpdateLikeDislike($postId, $userId, $like, $dislike) {
    // Vérifier si l'utilisateur a déjà aimé ou n'aime pas ce post
    $pdo = self::getInstance(); 
    $query = "SELECT id_like FROM likes WHERE id_post = :postId AND id_user = :userId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':postId', $postId);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // check

    $sql = "SELECT id_like FROM likes WHERE id_post = :postId AND id_user = :userId";
    $statement= self::$database->prepare($sql);
    $statement->execute(array( $userId, $postId,$like));
    

    if ( sizeof($statement->fetchAll()) == 0 ) {

        $sql = "INSERT INTO `likes` (`like`, `id_post`, `id_user`) 
        VALUES ('1',?,?)";
        $statement = self::$database->prepare($sql);
        $statement->execute(array(":id_post" => $postId, ":id_user" => $userId));
        
    }else{
        $sql = "DELETE FROM `like` 
        WHERE `like`.`id_post` = :postId
        AND `like`.`id_user` = :userId";

        $statement = self::$database->prepare($sql);
        $statement->execute(array(":postId" => $postId, ":userId" => $userId));
        

    }


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






public function UpdateUserStatuts($user_id, $status){
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET status = :status WHERE id_user = :user_id";
    $statement = $database->prepare($query);
    $statement->bindParam(":user_id", $user_id);
    $statement->bindParam(":status", $status);
    $statement->execute();
    return $statement->rowCount();
}


public function getAllEmails()
{
    $database = self::getInstance();
    $query = "SELECT adressemail FROM utilisateur";
    $statement = $database->prepare($query);
    $statement->execute();
    $emails = $statement->fetchAll(PDO::FETCH_COLUMN);
    return $emails;
}





function insertPost($user_id, $titre, $pseudo, $message,$date) {
    $database = self::getInstance();
    $sql = "INSERT INTO post (id_user, titre, pseudo, message,date) 
            VALUES (:user_id, :titre, :pseudo, :message,:date)";
    try {
        $statement = $database->prepare($sql);
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':message', $message);
        $statement->bindParam(':date', $date);

    
        $statement->execute();
        echo "Post added successfully";
    } catch(PDOException $e) {
        echo "Error adding post: " . $e->getMessage();
        die();
    }
}





public function getUserFromPost($post_id) {
    $database = self::getInstance();
    $query = "SELECT utilisateur.* FROM utilisateur INNER JOIN post ON post.id_user = utilisateur.id_user WHERE post.id_post = ?";
    $statement = $database->prepare($query);
    $statement->bindParam(1, $post_id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}




    

}