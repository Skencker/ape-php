<?php 
    require_once './admin/database.php';  
?>
<!DOCTYPE html>
<html lang="fr">
<?php 
          require_once 'head.php';
        ?>
    <body>
        <div class="container-fluid p-0 m-0">
        <?php 
          require_once 'header.php';
        ?>
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
                                <a href="actualites.php" class=" text-center p-2 ">
                                  <!-- <i class="bi bi-calendar3 "></i> -->
                                  Actualités / évènements </a>
                              </div>
                              <!-- <i class="bi bi-arrow-down-circle"></i> -->
                            </h1>
                        </div>
                        <!-- carroussel -->
                        <div class="col-lg-5 col-md-8 carroussel d-flex align-items-center justify-content-center ">

                            <div id="carousel" class="carousel slide carousel-fade carroussel d-flex align-items-center justify-content-center" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                  <?php
                                  $statement = $db->query('SELECT * FROM image_accueil', PDO::FETCH_ASSOC);
                                  $i = 1;
                                  foreach ($statement as $row) : ?>
                                      <div <?php if ($i <= 1) echo 'class="carousel-item active data-interval="1000"';
                                      else echo 'class="carousel-item data-interval="1000"' ?>>
                                      <img alt="image-ape" src="./images/<?= $row['image'] ?>" class="d-block w-75 img img-fluid ">
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

                    <div class="col-lg-6 col-sm-10 d-flex flex-column align-items-center ">
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
                            <div class="accordion-body">
                              <?php 
                                        // ON RECUPERE LES DONNEES
                                        $statement = $db->query('SELECT * FROM organigramme', PDO::FETCH_ASSOC); 
                                        $fichier = $statement->fetch();                            
                                          echo ' <a href="./doc/organigramme/'. $fichier['fichier'].'"> Organigramme </a>';              
                                          Database::disconnect();
                                    ?>
                            </div>
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
                  <div class="row w-75 mx-5">
                      <div class="col-md-4 col-sm-12 ">
                        <a href="actualites.php" class="d-flex flex-column my-5 lien  align-items-center">
                          <div class="d-flex justify-content-center ">
                            <i class="bi bi-star-fill text-center p-3"></i>
                          </div>
                          <hr >
                          <h3 class="text-center">Actu</h3>
                        </a>
                      </div>
                      <div class="col-md-4 col-sm-12  ">
                        <a href="actualites.php" class="d-flex flex-column my-5 lien align-items-center">
                          <div class="d-flex justify-content-center ">
                            <i class="bi bi-file-plus text-center p-3"></i>
                          </div>
                          <hr class="hr">
                          <h3 class="text-center">Liens</h3>
                        </a>
                      </div>
                      <div class="col-md-4 col-sm-12 ">
                        <a href="http://www.stpierredelages.fr/SITE/index.php?option=com_content&view=category&id=53&Itemid=88" target="_blank" class="d-flex flex-column my-5 lien align-items-center">
                          <div class="d-flex justify-content-center ">
                            <i class="bi bi-calendar3 text-center p-3"></i>
                          </div>
                          <hr >
                          <h3 class="text-center">Ecole / ALAE</h3>
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
                          <h5 class="card-title h4 pb-4">Parents délégués</h5>
                          <a href="parents.php" class="p-2" >En savoir plus</a>
                        </div>
                      </div>
                    </div>
                  <div class="col-lg-4 col-md-10 d-flex justify-content-center p-0">
                  <div class="card m-5 w-auto" style="width: 18rem;">
                    <img src="./images/livres.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title  h4 pb-4">Documents</h5>
                      <a href="doc.php" class="p-2" >En savoir plus</a>
                    </div>
                  </div>
                  </div>
                      <div class="col-lg-4 col-md-10 d-flex justify-content-center">
                        <div class="card m-5  w-auto" style="width: 18rem;">
                          <img src="./images/enfants.jpg" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title h4 pb-4">Informations écoles / ALAE</h5>
                            <a href="#" class="p-2">En savoir plus</a>
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
        </div>
        <?php 
          require_once 'footer.php';
        ?>
