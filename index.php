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

        <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
       
        <link rel="stylesheet" href="style.css" />
        <title>APE SPDL</title>
    </head>
    <body>
        <div class="container-fluid p-0 m-0">
            <header class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">
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
                                      <a class="nav-link active" aria-current="page" href="index.php"> Accueil</a>
                                    </li>
                                    <li class="nav-item me-5">
                                      <a class="nav-link " aria-current="page" href="./admin/index.php"> Admin</a>
                                    </li>
                                    <li class="nav-item me-5">
                                      <a class="nav-link" href="actualites.php">Actualités</a>
                                    </li>
                                    <li class="nav-item me-5">
                                      <a class="nav-link" href="parents.php">Parents Délégués</a>
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
            <main class="container-fluid p-0 m-0 " ps-0>
                <section class="baniere">
                      <div class="row margin h-100 justify-content-center">
                        <div class="col-lg-6 col-md-12 d-flex flex-column justify-content-center">
                            <h1 class="text-light text-lg-end pt-5 ps-5">
                              <div class="titre ">
                                Association <br>
                                Parents d'élèves <br> 
                                Saint Pierre de Lages  
                              </div>
                              <div class="bouton mt-2 mb-5">
                                <a href="actualites.html" class=" text-center p-3">
                                  <!-- <i class="bi bi-calendar3 "></i> -->
                                  Actualité / évènements </a>
                              </div>
                              <!-- <i class="bi bi-arrow-down-circle"></i> -->
                            </h1>
                        </div>
                        <!-- carroussel -->
                        <div class="col-lg-5 col-md-8 carroussel d-flex align-items-center justify-content-center ">

                            <div id="carousel" class="carousel slide carousel-fade carroussel d-flex align-items-center justify-content-center" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                  <?php
                                  $statement = $db->query('SELECT * FROM image_accueil');
                                  $i = 1;
                                  foreach ($statement as $row) : ?>
                                      <div <?php if ($i <= 1) echo 'class="carousel-item active data-interval="1000"';
                                      else echo 'class="carousel-item data-interval="1000"' ?>>
                                      <img alt="image-ape" src="./images/<?= $row['image'] ?>" class="d-block w-75 img " style="height: 400px width: 500px">
                                    </a>
                              </div>
                              <?php
                                $i++;
                              endforeach;
                              ?>
                            </div>
                        </div>
                      </div>    
                </section>
                <section class="association d-flex justify-content-center align-items-center ">
                  <div class="row m-0 justify-content-center">
                    <h2 class="text-center pb-5">L'association</h2>

                    <div class="col-lg-6 col-sm-10 d-flex flex-column align-items-center justify-content-center">
                      <div class="accordion accordion-flush align-self-center align-items-md-end w-100 p-5" id="accordionFlushExample">
                        <div class="accordion-item ">
                          <h2 class="accordion-header " id="flush-headingOne">
                            <button class="accordeon accordion-button collapsed mb-3 " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                              Présentation
                            </button>
                          </h2>
                          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Une association de parents d’élèves est une association qui regroupe exclusivement des parents d’élèves et les personnes ayant la responsabilité légale d’un ou plusieurs élèves.</div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordeon accordion-button collapsed  mb-3 font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                              Nos missions
                            </button>
                          </h2>
                          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Elle a pour objet la défense des intérêts moraux et matériels communs aux parents d’élèves. L’objectif de l’association est de mener des actions tout au long de l’année afin de récolter des fonds pour participer aux frais des projets de l’école (bus de la piscine, participation au frais des classse vertes, le bus des sorties scolaires…).</div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordeon accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                               Organigramme
                            </button>
                          </h2>
                          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"> <a href="organigramme.html">Organigramme</a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-10 image-reunion d-flex justify-content-center">
                      <img class="w-75 img-fluid img" src="./images/reunion.jpg" alt="">
                    </div> 
                  </div>
                </section>
                <section class="lien-info d-flex justify-content-center align-items-center text-white">
                  <div class="row">
                      <div class="col-md-3 col-sm-12 ">
                        <a href="actualites.html" class="d-flex flex-column m-5 lien  align-items-center">
                          <div class="d-flex justify-content-center ">
                            <i class="bi bi-star-fill text-center p-3"></i>
                          </div>
                          <hr >
                          <h3 class="text-center">Actu</h3>
                        </a>
                      </div>
                      <div class="col-md-3 col-sm-12 ">
                    <a href="actualites.html" class="d-flex flex-column m-5 lien align-items-center">
                      <div class="d-flex justify-content-center ">
                        <i class="bi bi-file-plus text-center p-3"></i>
                      </div>
                      <hr class="hr">
                      <h3 class="text-center">Liens</h3>
                    </a>
                      </div>
                      <div class="col-md-3 col-sm-12 ">
                      <a href="http://www.stpierredelages.fr/SITE/index.php?option=com_content&view=category&id=53&Itemid=88" target="_blank" class="d-flex flex-column m-5 lien align-items-center">
                        <div class="d-flex justify-content-center ">
                          <i class="bi bi-calendar3 text-center p-3"></i>
                        </div>
                        <hr >
                        <h3 class="text-center">Cantine</h3>
                      </a>
                      </div>
                    <div class="col-md-3 col-sm-12">
                        <a href="http://www.stpierredelages.fr/SITE/" target="_blank" class="d-flex flex-column m-5 lien align-items-center">
                      <div class="d-flex justify-content-center ">
                        <i class="bi bi-house text-center p-3"></i>
                      </div>
                      <hr>
                      <h3 class="text-center">Mairie</h3>
                    </a>
                  </div>
                  </div>
                  
                </section>
                <section class="cards d-flex justify-content-center">
                  <div class="row d-flex justify-content-center m-0">
                    <div class="col-lg-4 col-md-10 d-flex justify-content-center p-0">
                      <div class="card m-5 w-auto" style="width: 18rem;" >
                        <img src="./images/parents.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Parents délégués</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="parents.html" class="btn">En savoir plus</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-10 d-flex justify-content-center p-0">
                  <div class="card m-5 w-auto" style="width: 18rem;">
                    <img src="./images/livres.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Documents</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="doc.html" class="btn">En savoir plus</a>
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-4 col-md-10 d-flex justify-content-center">
                  <div class="card m-5  w-auto" style="width: 18rem;">
                    <img src="./images/enfants.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Divers</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn">En savoir plus</a>
                    </div>
                  </div>
                  </div>
                          
                </div>
                </section>
                <section class="contact d-flex justify-content-center align-items-center text-white ">
                    <div class="row d-flex justify-content-between align-items-center text-white w-100">
                      <div class="col-lg-6 justify-content-center">
                        <h3 class="text-center">Contactez nous</h3>
                      </div>
                      <div class="col-lg-6 d-flex justify-content-center">
                        <a href="mailto:sandrinekencker@hotmail.com" >Contact</a>
                      </div>
                    </div>
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