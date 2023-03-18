<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require_once("../model/profil.php");
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
              <li><a href="#"> <i class="fa fa-edit"></i> modifier profile</a></li>
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
</div>
</body>
</html>

