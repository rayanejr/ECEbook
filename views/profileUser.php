<?php 

require("../model/userProfileModel.php");

$db = new Database();
$posts= $db->getAllPostsByIduser($_SESSION["id_user"]);
$post_numbers_total = $db->getPostCountByUserId($user_profile["id_user"]);
$abonnements=$db-> getAllAbonnements();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-lq1jB4rkYZfoUUvIaXwh3pZlnbvyopoPb+aWYsIrpTmGkPTF/m2rdEJGU6zCj3X2" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../style/userProfile.css">
</head>
<body>
    

<?php require("../model/navbar.php") ?>
<div class="layout-content">

          <!-- Content -->
          <div class="container flex-grow-1 container-p-y">

            <!-- Header -->
            <div class="container-m-nx container-m-ny theme-bg-white mb-4">
              <div class="media col-md-10 col-lg-8 col-xl-7 py-5 mx-auto">
              <?php if($user["image"] != null) : ?>
                      <img class="d-block ui-w-100 rounded-circle" width="" 
                      src="../uploads/<?= $user_profile["image"]  ?>" alt="">
              <?php elseif ($user["image"] == null) : ?>
                      <img class="d-block ui-w-100 rounded-circle" width="" 
                      src="../uploads/avatar.png" alt="">
              <?php endif ; ?>
                <div class="media-body ml-5">
                  <h4 class="font-weight-bold mb-4"><?=   $user_profile["nom"] . " " . $user_profile["prenom"] ?></h4>

                  <div class="text-muted mb-4">
                    <?=  $user_profile["description"]  ?>
                  </div>

                  <a href="javascript:void(0)" class="d-inline-block text-body">
                    <strong><?= $nb_abonnement  ?></strong>
                    <span class="text-muted">followers</span>
                  </a>
                  <a href="javascript:void(0)" class="d-inline-block text-body ml-3">
                    <strong><?= $nb_abonné ?></strong>
                    <span class="text-muted">following</span>
                  </a>
                </div>
              </div>
              <hr class="m-0">
            </div>
            <!-- Header -->

            <div class="row">
              <div class="col">

                <!-- Info -->
                <div class="card mb-4">
                  <div class="card-body">

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">date de naissance:</div>
                      <div class="col-md-9">
                        <?=  $user_profile["datedenaissance"] ?>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">ville</div>
                      <div class="col-md-9">
                        <a href="javascript:void(0)" class="text-body"><?=  $user_profile["ville"]  ?></a>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">Email : </div>
                      <div class="col-md-9">
                        <a href="javascript:void(0)" class="text-body"><?=  $user_profile["adressemail"]  ?></a>
                      </div>
                    </div>

                   

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">Promo : </div>
                      <div class="col-md-9">
                        <?=   $user_profile["promo"] ?>
                      </div>
                    </div>

                 

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">Role : </div>
                      <div class="col-md-9">
                      <?=  $user_profile["roll"] ?>
                      </div>
                    </div>

                   

                  </div>
                  <div class="card-footer text-center p-0">
                    <div class="row no-gutters row-bordered row-border-light">
                      <a href="javascript:void(0)" class="d-flex col flex-column text-body py-3">
                        <div class="font-weight-bold"><?= $post_numbers_total  ?></div>
                        <div class="text-muted small">posts</div>
                      </a>
                      
                    </div>
                  </div>
                </div>
                <!-- / Info -->

                <!-- Posts -->
             

              
                <?php   
                $posts=$db->getAllPostsByIduser($user_profile["id_user"]);
                
                foreach($posts as $post) : 
               ?>

                <div class="card mb-4">
                  <div class="card-body">
                   

                    <div class="border-top-0 border-right-0 border-bottom-0 ui-bordered pl-3 mt-4 mb-2">
                      <div class="media mb-3">
                      <?php if($user["image"] != null) : ?>
                              <img class="d-block ui-w-40 rounded-circle" width="45" 
                              src="../uploads/<?= $user_profile["image"]  ?>" alt="">
                            <?php elseif ($user["image"] == null) : ?>
                              <img class="d-block ui-w-40 rounded-circle" width="45" 
                              src="../uploads/avatar.png" alt="">
                            
                            <?php endif ; ?>
                        <div class="media-body ml-3">
                         <?=  $user_profile["nom"] . " " . $user_profile["prenom"] ?>
                          <div class="text-muted small"><?=  $post["date"] ?></div>
                        </div>
                      </div>
                      <p>
                       <?=  nl2br($post["message"]) ?>
                      </p>
                      <?php if($post["image"] != null) : ?>
                      <img class="ui-rect ui-bg-cover" src="../uploads/<?=  $post["image"] ?>" alt="" srcset="">
                    <?php endif ?>
                    </div>
                  </div>
                  <div class="card-footer">
                    <?php $nombreLikes = $db->getCountforPostbyIdpost($post["id_post"]); ?>
                    <a href="javascript:void(0)" class="d-inline-block text-muted">
                      <small class="align-middle">
                        <strong><?=  $nombreLikes ?></strong> Likes</small>
                    </a>
                    <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">
                      <small class="align-middle">
                        <strong></strong> Comments</small>
                    </a>
                   
                  </div>
                </div>
        <?php endforeach ; ?>
                <!-- / Posts -->

              </div>
              <div class="col-xl-4">

                <!-- Side info -->
                
                <div class="card mb-4">
                  <div class="card-body">
                  <?php 
                  // Vérifier si l'utilisateur actuel est abonné à l'utilisateur en cours d'affichage
                  $isSubscribed = false;
                  foreach($abonnements as $abonnement){
                      if($abonnement["user1_id"] == $_SESSION['id_user'] && $abonnement["user2_id"] == $user['id_user']){
                          $isSubscribed = true;
                          break;
                      }
                  }
              ?>
              <?php if($isSubscribed) : ?>
                  <a href="../model/deleteSub.php?user_id=<?= $user["id_user"] ?>" class="btn btn-primary rounded-pill">+&nbsp; Suivi</a>
              <?php else : ?>
                  <a href="../model/addSub.php?user_id=<?= $user["id_user"] ?>" class="btn btn-primary rounded-pill">+&nbsp; Suivre</a>
              <?php endif; ?>


                  </div>
                  <hr class="border-light m-0">
                 
                  <hr class="border-light m-0">
                
                </div>
                <!-- / Side info -->

       

               
              </div>
            </div>

          </div>
          <!-- / Content -->

         
        </div>
      
</body>
</html>