<?php

require("../model/dashboard.php");
require("../controller/database.php");


// if($_SESSION["admin"] != true){
//     header("location:../views/connexion.php");
// }
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"]) &&
 $_SESSION(["admin"] != true)){
    header("location:../views/connexion.php");
    exit();
}



$db = new Database();
$users = $db->getAllUsers();
$posts = $db->getAllPosts();
$users_count = $db->getUserCount();
$post_count = $db->getPostCount();


?>







<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    
</style>

<link rel="stylesheet" href="../style/dash.css">

</head>


<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
               
                <!-- Divider -->
                <hr class="navbar-divider my-5 opacity-20">
                <!-- Navigation -->
           
                <!-- Push content down -->
                <div class="mt-auto"></div>
                <!-- User (md) -->
              
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div  class="container-fluid">
                <div  class="mb-npx">
                <a class="nav-link" href="../model/logout.php">
                            <i class="bi bi-box-arrow-left"></i> deconnexion
                        </a>
                    <div class="row align-items-center">
                        <!-- Actions -->
                    
                    </div>
                    <!-- Nav -->
                 
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                <!-- Card stats -->
                <div class="row g-6 mb-6">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">utilsateurs inscrits </span>
                                        <span class="h3 font-bold mb-0"><?=  $users_count; ?></span>
                                    </div>
                                    
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Nombre de posts publié </span>
                                        <span class="h3 font-bold mb-0"><?=  $post_count;  ?></span>
                                    </div>
                                  
                                </div>
                             
                            </div>
                        </div>
                    </div>

                
                </div>
                <div id="users" class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <h5 class="mb-0">utilisateur</h5>
                        <a class="btn btn-primary" data-toggle="modal" href='#susbc-form'>Ajouter un utilisateur</a>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Pseudo</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">role</th>
                                    <th scope="col">promo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) : ?>
                                <tr>
                                    <td>
                                        <img alt="..." src="../uploads/<?=  $user["image"]  ?>" class="avatar avatar-sm rounded-circle me-2">
                                        <a class="text-heading font-semibold" href="#">
                                            <?= $user["pseudo"] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=  $user["description"] ?>
                                    </td>
                                    <td>
                                        <?=  $user["adressemail"]  ?>
                                    </td>
                                    <td>
                                        <?=  $user["roll"] ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-lg badge-dot">
                                            <i class="bg-success"></i> <?= $user["promo"] ?>
                                        </span>
                                    </td>
                                    <?php if($user["roll"] != "admin") : ?>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-neutral">modifier</a>
                                       
                                        <a class="btn btn-sm btn-square btn-danger text-danger-hover" href="../model/deleteUserAdmin.php?user_id=<?= $user["id_user"]  ?>"> <i class="bi bi-trash"></i> </a>
                                    </td>
                                    <?php endif ?>
                                </tr>
                          
                     <?php endforeach ; ?>
                             
                            </tbody>
                        </table>
                    </div>
                   
                </div>




                <!-- post table -->
                <div id="post" class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <h5 class="mb-0">Post</h5>
                        <a class="btn btn-primary" data-toggle="modal" href='#post-form'>Ajouter un post</a>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">titre</th>
                                    <th scope="col">message</th>
                                    <th scope="col">publié par </th>
                                    <th scope="col">date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($posts as $post) : ?>
                                <tr>
                                    
                                    <td>
                                        <?=  $post["titre"] ?>
                                    </td>
                                    <td>
                                        <?=  $post["message"]  ?>
                                    </td>
                                    <td>
                                        <?=  $post["pseudo"] ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-lg badge-dot">
                                             <?= $post["date"] ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-neutral">modifier</a>
                                       
                                        <a class="btn btn-sm btn-square btn-danger text-danger-hover" href="../model/deletePostAdmin.php?post_id=<?= $post["id_post"]  ?>"> <i class="bi bi-trash"></i> </a>
                                    </td>
                                    
                                </tr>
                          
                     <?php endforeach ; ?>
                             
                            </tbody>
                        </table>
                    </div>
                   
                </div>



<!-- modal add user -->
                <div class="text-center jumbotron">
</div>
		<div class="modal fade" id="susbc-form">
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
                            <form action="../model/AddUser.php"  method="POST" enctype="multipart/form-data">


  
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-sm-30 m-auto">
                                    <div class="card">
                                        <div class="card-body">

                          
               
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Nom</span>
                            <input class="form-control" type="text" name="nom" placeholder="Tapez votre nom..." required><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Prénom</span>
                            <input class="form-control" type="text" name="prenom" placeholder="Tapez votre prénom..." required><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <input class="form-control" type="file" name="image"  required><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Date de naissance</span>
                            <input class="form-control" type="date" name="naissance" placeholder="Date" required><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Ville</span>
                            <input class="form-control" type="text" name="ville" placeholder="Ville" required><br><br>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Email</span>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Tapez votre email..." required><br><br>
                        </div>
                    </div>
           
               
                        <div class="form-group mb-3" id="promo-group" style="display:none">
                            <label for="promo">Promo:</label>
                            <select name="promo" multiple id="selectPromo">
                            <option value="ING1">ING1</option>
                            <option value="ING2">ING2</option>
                            <option value="ING3">ING3</option>
                            <option value="ING4">ING4</option>
                            <option value="ING5">ING5</option>
                            <option value="B1">B1</option>
                            <option value="B2">B2</option>
                            <option value="B3">B3</option>
                            <option value="M1">M1</option>
                            <option value="M2">M2</option>
                            </select>
                        </div>
               
            


             


                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Username</span>
                            <input class="form-control" type="text" name="username" placeholder="Votre username" required><br><br>
                        </div>
                    </div>
                   
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Password</span>
                            <input class="form-control" type="password" name="motdepasse" placeholder="Tapez votre mot de passe..." minlength="10"><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Description</span>
                            <input class="form-control" type="text" name="description" placeholder="Tapez votre mot de passe..."><br><br>
                        </div>
                    </div>
                    <input class="btn btn-primary btn-lg" style="margin-left: 39%;" type="submit" name="submit" value="Ajouter"><br><br>
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
		<div class="modal fade" id="susbc-form-thank">
			<div class="modal-dialog">
				<div class="modal-content sub-bg shadow-lg">
					<div class="modal-header subs-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<!-- <h4 class="modal-title">Modal title</h4> -->
					</div>
					
				</div>
			</div>
		</div>



            </div>
        </main>
    </div>
</div>






<!-- modal add post -->
<div class="text-center jumbotron">
</div>
		<div class="modal fade" id="post-form">
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
                            <form action="../model/AddPostAdmin.php"  method="POST" enctype="multipart/form-data">


  
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-sm-30 m-auto">
                                    <div class="card">
                                        <div class="card-body">

                          
               
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">titre</span>
                            <input class="form-control" type="text" name="titre" placeholder="entrez un titre" required><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                            <span class="input-group-text">Post</span>
                            <input class="form-control" type="text" name="message" placeholder="entrez un post" required><br><br>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group mb-3 w-100 flex-nowrap">
                        <input type="file" class="form-control" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Upload image</label>
                        </div>
                    </div>
                    <input class="btn btn-primary btn-lg" style="margin-left: 39%;" type="submit" name="submit" value="Ajouter"><br><br>
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
						<!-- <h4 class="modal-title">Modal title</h4> -->
					</div>
					
				</div>
			</div>
		</div>



            </div>
        </main>
    </div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>