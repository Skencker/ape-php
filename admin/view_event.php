
<?php 
    require 'database.php';
    //recupere l'id de l'image dans URL
    if(!empty($_GET['id'])) {
        $id = checkInput($_GET['id']);
      }
      //connection à la basse de donnée
      $db = Database::connect();
  
      $statement = $db->prepare('SELECT evenement.id, evenement.nom, evenement.image, evenement.date, evenement.fichier, evenement.description
                                FROM evenement
                                WHERE evenement.id = ?');
  
    $statement->execute(array($id));
  
    $event = $statement->fetch();
    Database::disconnect();
  
      //fonction pour sécurisé les données
      function checkInput ($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
  
    ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Font google-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"rel="stylesheet" />
    
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap"rel="stylesheet"
        />
        <!--Jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!--Bootstrap-->
        <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
          crossorigin="anonymous"
        />
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
        />

        <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
       
        <link rel="stylesheet" href="../style.css" />
        <title>APE SPDL ADMIN</title>
    </head>
    <body>

        <header class="">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">
                <div class="container-fluid">
                    <a href="#"> 
                        <img class="img img-fluid w-75 ps-3" src="../images/logo.png" alt="logo">
                    </a>
                    <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse lg-d-flex bg-light justify-content-end " id="navbarSupportedContent">
                        <div >
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0  ">
                            <li class="nav-item me-5">
                                    <a class="nav-link border-3" aria-current="page" href="../index.php">Site</a>
                                </li>                               
                                <li class="nav-item me-5">
                                    <a class="nav-link active" aria-current="page" href="index.php">Gestion admin</a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
                </nav>
        </header>

        <div class="container  bg-light p-5 mt-5" style="height: 800px" >
            <a href="index.php" class="btn btn-primary mb-5 " > <i class="bi bi-arrow-return-left p-1"></i> Retour</a>
        <div class="row d-flex justify-content-center align-items-center">
     
                <?php
         
                        echo '
                        <div class="col-lg-6 col-md-12 ">
                            <img class="img img-fluid" src="../images/'. $event['image'] .  '"alt="">
                        </div>
                        <div class="col p-5">
                            <h2 >'. $event['nom'].'</h2>
                            <hr>
                            <h4>'. $event['date'] . '</h4>
                            <p>'. $event['description'] . '</p>
                        
                            <a href="../doc/'. $event['fichier'] . '">'. $event['fichier'] . '</a>
                        </div>';
                    
                ?>
                </div>
               
            <!-- <div class="col-lg-6 col-md-12">
                <img src="../images/<?php echo $event['image'];?>" alt="... " class="w-50">
                <div class=''>
                    <a href="index.php" class="btn btn-primary m-2" > <i class="bi bi-arrow-return-left p-1"></i> Retour</a>
                  </div>
            </div> -->
        </div>
        </div>

        <footer class="container-fluid d-flex justify-content-evenly pt-3 bg-light fixed-bottom">
        <p>Copyright © APE Saint-Pierre-de-Lages</p>
    </footer>
    
</body>
 <!--Bootstrap-->
 <script
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
 crossorigin="anonymous"
></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="app.js"></script>
</html>