<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require_once("../model/profil.php");


// require("../controller/database.php");
$db = new Database();
$posts= $db->getAllPostsByIduser($_SESSION["id_user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/profile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <title>Profil</title>
</head>
<body>
    <?php require("../model/navbar.php") ?>
<div class="container bootstrap snippets bootdey">
    <div class="row">
    <div class="profile-nav col-md-3">
        <div class="panel">
            <div class="user-heading round">
                <a href="#">
                    <img src="../uploads/<?= $user["image"]  ?>" alt="">
                </a>
                <h1><?=  $user["nom"] . " " . $user["prenom"] ?></h1>
                <p><?=  $user["adressemail"] ?></p>
            </div>

            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
                <li><a href="../views/updateUser.php"> <i class="fa fa-edit"></i> modifier profile</a></li>
                <li><a href="../model/deleteUser.php"> <i class="fa fa-edit"></i> supprimer le profil</a></li>
            </ul>
        </div>
    </div>
    <div class="profile-info col-md-9">

        <div class="panel">
            <div class="bio-graph-heading">
                <?=  $user["description"] ?>
            </div>
            <div class="panel-body bio-graph-info">
                <h1>Profile informations </h1>
                <div class="row">
                    <div class="bio-row">
                        <p><span>Nom </span>: <?= $user["nom"]  ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>prenom </span>: <?=  $user["prenom"] ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>ville </span>: <?= $user["ville"]  ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>Mail</span>: <?= $user["adressemail"] ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>role </span>: <?=  $user["roll"] ?> </p>
                    </div>
                    <div class="bio-row">
                        <p><span>promo </span>: <?=  $user["promo"] ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>Naissance </span>: <?= $user["datedenaissance"] ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>pseudo </span>: <?=  $user["pseudo"] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div>
        
        </div>
    </div>
    </div>
    <?php
    $posts=$db->getAllPostsByIduser($user["id_user"]);
    foreach($posts as $post){
        ?>



  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-md-9 col-lg-7 col-xl-5">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex text-black">
              <div class="flex-shrink-0">
              <img src="../uploads/<?= $user["image"]  ?>" class="img-circle avatar" 
                        
                  alt="Generic placeholder image" class="img-fluid"
                  style="width: 180px; border-radius: 10px;">
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1"><?=  $user["nom"] . " " . $user["prenom"] ?></h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;"><?= $post["date"] ?></p>
                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                  style="background-color: #efefef;">
                  <div>
                    <p class="small text-muted mb-1">Articles</p>
                    <p class="mb-0"><?= $post["message"] ?></p>
                  </div>
                  
                </div>
                <div class="d-flex pt-1">
                  <button type="button" class="btn btn-outline-primary me-1 flex-grow-1">Chat</button>&nbsp;
                    <?php
                        $likes = $db->GetLikeByPostId($post["id_post"]);
                            if(isset($likes["type"])){
                                if($likes["type"] == 0) {
                                    echo '<button type="button" class="btn btn-outline-primary me-1 flex-grow-1">
                                    <a href="../model/addLikebyUser.php?post_id='.$post["id_post"].'&user_id='.$post["id_user"].'&type=1">
                                    <i class="fa fa-gittip" name="like"></i>Like</a>
                                    </button>';
                                    
                                } else if($likes["type"] == 1) {
                                    echo '<button type="button" class="btn btn-outline-primary me-1 flex-grow-1">
                                    <a href="../model/addLikebyUser.php?post_id='.$post["id_post"].'&user_id='.$post["id_user"].'&type=0">
                                    <i class="fa fa-gittip" name="like"></i>Disike</a>
                                    </button>';
                                }
                            } else {
                                echo '<button type="button" class="btn btn-outline-primary me-1 flex-grow-1">
                                    <a href="../model/addLikebyUser.php?post_id='.$post["id_post"].'&user_id='.$post["id_user"].'&type=1">
                                    <i class="fa fa-gittip" name="like"></i>Like</a>
                                    </button>';
                            }
                     ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

        <?php
    }
    ?>
</div>


</body>
</html>

