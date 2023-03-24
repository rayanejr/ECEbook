<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require_once("../model/profil.php");


$db = new Database();
$posts = null;
$post_id = intval($_GET["post_id"]);
$user_id = intval($_GET["user_id"]);
if (isset($post_id)) {
    echo "ok";
    $posts = $db->getPostsByIduserAndIdPost($user_id, $post_id);
};


var_dump($post_id);
var_dump($user_id);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

foreach($posts as $post):

?>
<!-- modal modif  post -->
<div class="text-center jumbotron">
</div>
		<div class="modal fade">
			<div class="modal-dialog shadow-lg p-3 mb-5 bg-white rounded">
				<div class="modal-content sub-bg">
					<div class="modal-header subs-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<!-- <h4 class="modal-title">Modal title</h4> -->
					</div>
					<div class="modal-body">
						<div class="text-center">
						</div>
					
						<div class="row">
							<div class="col-md-12">
                            <form action="../model/updatePostUser.php?post_id=<?=  $post['id_post']; ?>&user_id=<?=  $post['id_user'];?>"  method="POST" enctype="multipart/form-data">


  
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-sm-30 m-auto">
                                    <div class="card">
                                        <div class="card-body">

                          
               
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">titre</span>
                            <input class="form-control" type="text" name="titre" placeholder="entrez un titre" value='<?= $post["titre"] ?>' required><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Post</span>
                            <input class="form-control" type="text" name="message" placeholder="entrez un post" value="<?=  $post["message"] ?>" required><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                        <input type="file" class="form-control" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Upload image</label>
                        </div>
                    </div>
                    <input class="btn btn-primary btn-lg" style="margin-left: 39%;" type="submit" name="submit" value="Modifier"><br><br>
                </div>
              
              </div>
             
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                <form action="../model/updatePostUser.php?post_id=<?=  $post['id_post']; ?>&user_id=<?=  $post['id_user'];?>"  method="POST" enctype="multipart/form-data">

                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Titre</label>
                              <input class="form-control" type="text" name="titre"  value="<?=  $post["titre"] ?>" required>
                            </div>
                          </div>
                         
                        </div>
                    
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>Message</label>
                              <textarea name="message" class="form-control" rows="5" required>
                              <?= $post["message"] ?>
                              </textarea>
                            </div>
                          </div>
                        </div>



                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>image</label>
                              <input type="file" class="form-control" id="customFile" name="image">
                            </div>
                          </div>
                        </div>






                      </div>
                    </div>
                   
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" name="submit" type="submit">Sauvegarder les modifications</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
        </div>
    </div>
</div>
</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="post-form-thank">
			<div class="modal-dialog">
				<div class="modal-content sub-bg shadow-lg">
					<div class="modal-header subs-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						
					</div>
					
				</div>
			</div>
		</div>



            </div>
        </main>
    </div>

<?php endforeach ; ?>



</body>
</html>