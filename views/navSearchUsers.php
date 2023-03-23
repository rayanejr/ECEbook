<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    
    <div class="container" style="max-width: 50%">
        <a class="btn btn-primary" href="../views/index2.php" role="button" style="margin-left: -50%; margin-top: 15px;">Retour</a>
        <div class="text-center mt-5 mb-4">
            <h2>Recherche utilisateur</h2>
        </div>
        <input type="text" class="form-control" id="live_search" autocomplete="off"
            placeholder="Search...">

    </div>

    <div id="searchresult">

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#live_search").keyup(function(){
                var input = $(this).val();
                //alert(input);
                if (input != ""){
                    $.ajax({
                        url:"../model/livesearch.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#searchresult").html(data);
                            $("#searchresult").css("display","block");
                        }
                    });
                }else{
                    $("#searchresult").css("display","none");
                }
            });
        });
    </script>

</body>
<footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase text-primary">A propos</h5>
                    <p>Site web officiel ECEBOOK de l'école d'ingénieur ECE Paris.</p>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase text-primary">Nos services</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#" class="text-dark" id="service">Service 1</a>
                        </li>
                        <li>
                            <a href="#" class="text-dark" id="service">Service 2</a>
                        </li>
                        <li>
                            <a href="#" class="text-dark" id="service">Service 3</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0 text-primary">Nous contacter</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fas fa-envelope me-3"></i>
                            sami.abdulhalim@gmail.com
                        </li>
                        <li>
                            <i class="fas fa-phone me-3"></i>
                            +06 99 99 99 99
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt me-3"></i>
                            Paris, France 75015
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center p-3" style="background-color: #2C3E50;">
            <span style="color: #FFF;">© ECE BOOK 2023:</span>
            <a class="text-light" href="#">Legal</a>
        </div>
    </footer>
</html>
<style>
    footer {
        padding-top: 28%;
    }
    
    
</style>