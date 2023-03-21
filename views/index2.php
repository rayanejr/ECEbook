<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location:../views/connexion.php");
    exit();
}

require("../controller/database.php");
$db = new Database();
$posts = $db->getAllPosts() ; 

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


        

        


</head>
<body>
    


<style>
    body {
            background-color: #eeeeee;
        }

        .h7 {
            font-size: 0.8rem;
        }

        .gedf-wrapper {
            margin-top: 0.97rem;
        }

        @media (min-width: 992px) {
            .gedf-main {
                padding-left: 4rem;
                padding-right: 4rem;
            }
            .gedf-card {
                margin-bottom: 2.77rem;
            }
        }

        /**Reset Bootstrap*/
        .dropdown-toggle::after {
            content: none;
            display: none;
        }
</style>

       
<?php  require("../model/navbar.php") ?>


    <div class="container gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
               
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <form action="../model/addPost.php" method="POST">
                <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Publiez </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                            <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                   
                                    <input class="form-control" type="text" name="titre" placeholder="entrez un titre" required><br><br>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="message">Post</label>
                                    <textarea class="form-control" name="message" id="message" rows="3" placeholder="entrez un message ?"></textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <label class="custom-file-label" for="customFile">Upload image</label>
                                    </div>
                                </div>
                                <div class="py-4"></div>
                            </div>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit" name="submit" class="btn btn-primary">Publier</button>
                            </div>
                          
                        </div>
                    </div>
                </div>
                </form>
                <!-- Post /////-->

                <!--- \\\\\\\Post-->
                <?php foreach ($posts as $post): ?>
                        <?php       

                    // Get user information
                    $user_id = $post['id_user'];
                    $user = $db->getUserById($user_id);

                        ?>
                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="../uploads/<?= $user["image"]  ?>" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><?=  $user["pseudo"] ?></div>
                                </div>
                            </div>
                            <div>
                             
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i><?= $post["date"]?></div>
                        <a class="card-link" href="#">
                            <h5 class="card-title"><?= $post["titre"] ?></h5>
                        </a>

                        <p class="card-text">
                           <?=  $post["message"] ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                        <a href="tempo_ajout_commentaire.php?id_post=<?php echo $post["id_post"]?>" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                        <button > <a href="" class="card-link">ajouter un like </a></button>
                    </div>
                </div>
                <?php endforeach ; ?>
                <!-- Post /////-->



            </div>
         
        </div>
    </div>





</body>
</html>