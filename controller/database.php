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
        echo $user['email'];
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
    $query = "DELETE FROM utilisateur WHERE id_user = :user_id";
    $statement = $database->prepare($query);
    $statement->bindParam(":user_id", $user_id);
    $statement->execute();
    return $statement->rowCount();
}

public function deletePostById($id_post) {
    $database = self::getInstance();
    $query = "DELETE FROM post WHERE id_post=:post_id";
    $statement = $database->prepare($query);
    $statement->bindParam(":post_id", $id_post);
    $statement->execute();
    return $statement->fetch();
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
public function updateUserById($user_id, $nomU, $prenomU, $naissanceU, $villeU,  $usernameU, $mdpU, $descriptionU, $emailUser,$confirmerUser,$promoUser,$imageUser) {
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET nom=?, prenom=?, datedenaissance=?, ville=?,  pseudo=?, mdp=?, description=?, adressemail=?, confirmer=? , promo=?, image=? , roll=?  WHERE id_user=?";
    $roll = (strpos($emailUser, '@admin') !== false) ? 'admin' : 'etudiant'; // check if email contains "@admin"
    $statement = $database->prepare($query);
    $statement->execute([$nomU, $prenomU, $naissanceU, $villeU, $usernameU, $mdpU, $descriptionU, $emailUser,$confirmerUser,$promoUser, $imageUser, $roll,  $user_id]);
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

public function getAllPostsByIduser($id_user) {
    $database = self::getInstance();
    $query = "SELECT * FROM post WHERE id_user=:user_id";
    $statement = $database->prepare($query);
    $statement->bindParam(":user_id", $id_user);
    $statement->execute();
    return $statement->fetchAll();
}

public function deletePostByIdUserAndIdpost($id_user, $id_post){
    $database = self::getInstance();
    $query = "DELETE FROM post WHERE id_user=:user_id AND id_post=:post_id";
    $statement = $database->prepare($query);
    $statement->bindParam(":user_id", $id_user);
    $statement->bindParam(":post_id", $id_post);
    $statement->execute();
    return $statement->fetch();

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


function getAllUsers() {
    $pdo = self::getInstance();
    $sql = "SELECT * FROM utilisateur  ORDER BY roll = 'admin' DESC";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}






public function updatePostById($id_post, $titre, $message, $image) {
    $database = self::getInstance();
    $query = "UPDATE post SET titre=:titre, message=:message, image=:image WHERE id_post=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_post);
    $statement->bindParam(':titre', $titre);
    $statement->bindParam(':message', $message);
    $statement->bindParam(':image', $image);
    $statement->execute();
    return $statement->fetch();
}

//-------------------Commentaire-------------------------------------------

public function AddComment($id_user, $id_post, $commentaire)
{
    try {
        $sql = "INSERT INTO `commentaires` (`id_user`, `id_post`, `contenu`)
        VALUES (:id_user, :id_post, :commentaire)";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':id_post', $id_post);
        $statement->bindParam(':commentaire', $commentaire);
        $statement->execute();
        echo "Welcome";
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout du commentaire: " . $e->getMessage();
        die();
    }
}

public function GetCommentById($id_comment) {
    $database = self::getInstance();
    $query = "SELECT * FROM commentaires WHERE id=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_comment);
    $statement->execute();
    return $statement->fetch();
}

public function GetCommentByUserId($id_user) {
    $database = self::getInstance();
    $query = "SELECT * FROM commentaires WHERE id_user=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_user);
    $statement->execute();
    return $statement->fetchAll();
}

public function GetCommentByPostId($id_post) {
    $database = self::getInstance();
    $query = "SELECT * FROM commentaires WHERE id_post=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_post);
    $statement->execute();
    return $statement->fetchAll();
}

public function GetComment() {
    $database = self::getInstance();
    $query = "SELECT * FROM commentaires";
    $statement = $database->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

public function deleteCommentById($id_comment) {
    $database = self::getInstance();
    $query = "DELETE FROM commentaires WHERE id=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_comment);
    $statement->execute();
    return $statement->fetch();
}

public function updateCommentById($id_comment, $commentaire) {
    $database = self::getInstance();
    $query = "UPDATE commentaires SET commentaire_text=:commentaire WHERE id=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_comment);
    $statement->bindParam(':commentaire', $commentaire);
    $statement->execute();
    return $statement->fetch();
}

public function AddLike($id_post, $id_user, $type)
{
    try {
        $sql = "INSERT INTO `likes` (`id_post`, `id_user`, `type`) VALUES (:id_post, :id_user, :type)
        ON DUPLICATE KEY UPDATE `type` = :type";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':id_post', $id_post);
        $statement->bindParam(':id_user', $id_user);
        $statement->bindParam(':type', $type);
        $statement->execute();
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
        die();
    }
}

//--------------------LIKE------------------------------------

public function GetLikeById($id_like) {
    $database = self::getInstance();
    $query = "SELECT * FROM likes WHERE id_like=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_like);
    $statement->execute();
    return $statement->fetch();
}

public function GetLikeByUserId($id_user) {
    $database = self::getInstance();
    $query = "SELECT * FROM likes WHERE id_user=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_user);
    $statement->execute();
    return $statement->fetchAll();

}

public function GetLikeByPostId($id_post) {
    $database = self::getInstance();
    $query = "SELECT * FROM likes WHERE id_post=:id";
    $statement = $database->prepare($query);
    $statement->bindParam(":id", $id_post);
    $statement->execute();
    return $statement->fetchAll();
}

public function GetLike() {
    $database = self::getInstance();
    $query = "SELECT * FROM likes";
    $statement = $database->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}




//-------------------------------------------------------------------------------------

public function UpdateUserStatuts($user_id, $status){
    $database = self::getInstance();
    $query = "UPDATE utilisateur SET status = :status WHERE id_user = :user_id";
    $statement = $database->prepare($query);
    $statement->bindParam(":user_id", $user_id);
    $statement->bindParam(":status", $status);
    $statement->execute();
    return $statement->rowCount();
}


public function getUserCount() {
    $database = self::getInstance();
    $query = "SELECT COUNT(*) as count FROM utilisateur";
    $statement = $database->prepare($query);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row['count'];
}


public function getPostCount() {
    $database = self::getInstance();
    $query = "SELECT COUNT(*) as count FROM post";
    $statement = $database->prepare($query);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row['count'];
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


//--------------------------ABONNEMENT-------------------------

public function addSubcriber($id_user1, $id_user2)
{
    $database = self::getInstance();
    $query = "INSERT INTO abonnement (user1_id, user2_id) VALUES (:user1_id, :user2_id)";
    try{
        $statement = $database->prepare($query);
        $statement->bindParam(':user1_id', $id_user1);
        $statement->bindParam(':user2_id', $id_user2);
        $statement->execute();

        echo "<script>alert('Vous êtes maintenant abonné !');</script>";
    }catch(PDOException $e){

        //echo "Error adding subscriber: " . $e->getMessage();
        header("location: ../views/index2.php");
        die();
    }
}  

//prendre les abonnement d'un utilisateur
public function getSubsByUser1Id($user1_id)
{
    $database = self::getInstance();
    $query = "SELECT * FROM abonnement WHERE user1_id=:user1_id";

    try{
        $statement = $database->prepare($query);
        $statement->bindParam(':user1_id', $user1_id);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }catch(PDOException $e){
        echo "Error getting the subscribers: " . $e->getMessage();

        die();
    }
}

//prendre les abonnés d'un utilisateur
public function getSubsByUser2Id($user2_id)
{
    $database = self::getInstance();
    $query = "SELECT * FROM abonnement WHERE user2_id=:user2_id";

    try{
        $statement = $database->prepare($query);
        $statement->bindParam(':user2_id', $user2_id);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }catch(PDOException $e){
        echo "Error getting the subscribers: " . $e->getMessage();
        die();
    }
}

public function unsubByAbonnementId($id_user1, $id_user2)
{
    $database = self::getInstance();
    $query = " DELETE * FROM abonnnement where user2_id = :id_user2 AND user1_id = :id_user1";

    try{
        $statement = $database->prepare($query);
        $statement->bindParam(':user2_id ', $id_user2);
        $statement->bindParam(':user1_id ', $id_user1);
        $statement->execute();
    }catch(PDOException $e){
        echo "Error deleting a subscriber: " . $e->getMessage();
        die();
    }
}

}