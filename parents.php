<?php 
    require './admin/database.php';
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font google-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Caveat&display=swap"
      rel="stylesheet"
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

    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="style.css" />
    <title>APE SPDL</title>
  </head>
  <body>
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a href="#"> 
                  <img class="img img-fluid w-75 ps-3" src="./images/logo.png" alt="logo">
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
                              <a class="nav-link " aria-current="page" href="index.php"> Accueil</a>
                            </li>
                            <li class="nav-item me-5">
                              <a class="nav-link" href="actualites.php">Actualités</a>
                            </li>
                            <li class="nav-item me-5">
                              <a class="nav-link active" href="parents.php">Parents Délégués</a>
                            </li>
                            <li class="nav-item me-5">
                            <a class="nav-link" href="doc.php">Documents</a>
                            </li>
                        
                            <li class="nav-item me-5">
                              <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                         
                        </ul>
                      </div>
                </div>
            </div>
          </nav>
    </header>
    <main>
        <section class="baniere-parents d-flex justify-content-center">
            <h1 class="align-self-center">Parents délégués</h1>
        </section>
        <section class="parents container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-1">   </div>
                      <H2 class="text-center">PS / MS</H2>
                    
                      <?php
                        $statement = $db->query('SELECT parents_delegues.id, parents_delegues.nom, parents_delegues.prenom, parents_delegues.fonction AS fonction, parents_delegues.classe AS classe, parents_delegues.image   
                                                FROM parents_delegues
                                                LEFT JOIN `fonctions_parents_delegues`
                                                ON parents_delegues.fonction = fonctions_parents_delegues.nom
                                                LEFT JOIN `classes`
                                                ON parents_delegues.classe = classes.nom');

                        while($parent = $statement->fetch()) {
                            // var_dump($parent);
                            echo' 
                            <div class="row">
                            <div class="col-1">   </div>
                            <div class=" classe col-2 ">
                        
                            <div class="row">';
                           
                                    if($parent['fonction']=='1') {
                                        echo '    
                                        <img class="img img-fluid" src="./images/'. $parent['image'].'" alt="">
                                        <p class="text-center">Titulaire: </br>';
                                        echo $parent['nom'];
                                        echo '</br>';
                                        echo $parent['prenom'];
                                        echo '</br>';
                                        echo $parent['fonction'];
                                      
                                    };
                            echo'</div>
                            <div class="row">';
                                    if($parent['fonction']=='2') {
                                        echo '    
                                        <img class="img img-fluid " src="./images/'. $parent['image'].'" alt="">
                                        <p class="text-center">Suppléant: </br>';
                                        echo $parent['nom'];
                                        echo '</br>';
                                        echo $parent['prenom'];
                                    };
                                echo'</div>
                            </div>';
                        
             

                        }

                   
                     
                  ?>
                
                <div class=" col-1">   </div>
            </div>
        </section>

        <section class="contact d-flex justify-content-sm-evenly align-items-center text-white">
                
            <h3>Contactez nous</h3>
            <a href="mailto:sandrinekencker@hotmail.com" >Contact</a>
        </section>
    </main>
    <footer class="container-fluid d-flex justify-content-evenly pt-3 bg-light">
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
