<?php 
    require './admin/database.php';
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();
?>

<!DOCTYPE html>
<html lang="fr">
<?php 
          require_once 'head.php';
        ?>
  <body>
  <?php 
          require_once 'header.php';
        ?>
    <main>
        <section class="baniere-parents d-flex justify-content-center">
            <h1 class="align-self-center">Parents délégués</h1>
        </section>
        <section class="parents container-fluid d-flex align-items-center justify-content-center">
          <div class="row d-flex justify-content-center align-items-start">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                <h2 class='text-center'>PS /MS</h2>
                <div class="row">
                  <?php
                        $statement = $db->query('SELECT * FROM parents_delegues ORDER BY fonction DESC');

                    
                        while($data = $statement->fetch()) {
                      
                          if($data['classe'] == 'PS / MS') {
                              
                            echo ' 
                                <div class="col-6">
                                  <div class="row"> 
                                    <img src ="./images/'. $data['image'] .'"/>
                                  </div>
                                  <div class="row d-flex justify-content-center fw-bolder"> '. $data['fonction'] .'</div>
                                  <div class="row d-flex justify-content-center text-center"> '. $data['nom'] .' '. $data['prenom'] .'</div>
                                </div>
                                ';
                              } 
                            }
                  ?>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2">
                <h2 class='text-center'>GS / CP</h2>
                <div class="row">
                  <?php
                    // $statement = $db->query('SELECT * FROM parents_delegues ORDER BY fonction DESC');
                    while($data = $statement->fetch()) {
                      if($data['classe'] == 'GS / CP') {
                        echo ' 
                            <div class="col-6">
                              <div class="row"> 
                                <img src ="./images/'. $data['image'] .'"/>
                              </div>
                              <div class="row d-flex justify-content-center fw-bolder"> '. $data['fonction'] .'</div>
                              <div class="row d-flex justify-content-center text-center"> '. $data['nom'] .' '. $data['prenom'] .'</div>
                            </div>
                            ';
                          } 
                        }
                  ?>
                </div>
            </div> 
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2">
                <h2 class='text-center'>CP / CE1</h2>
                <div class="row">
                  <?php
                    // $statement = $db->query('SELECT * FROM parents_delegues ORDER BY fonction DESC');
                    while($data = $statement->fetch()) {
                      if($data['classe'] == 'CP / CE1') {
                        echo ' 
                            <div class="col-6">
                              <div class="row"> 
                                <img src ="./images/'. $data['image'] .'"/>
                              </div>
                              <div class="row d-flex justify-content-center fw-bolder"> '. $data['fonction'] .'</div>
                              <div class="row d-flex justify-content-center text-center"> '. $data['nom'] .' '. $data['prenom'] .'</div>
                            </div>
                            ';
                          } 
                        }
                  ?>
                </div>
            </div> 
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2">
                <h2 class='text-center'>CE2 / CM1</h2>
                <div class="row">
                  <?php
                    // $statement = $db->query('SELECT * FROM parents_delegues ORDER BY fonction DESC');
                    while($data = $statement->fetch()) {
                      if($data['classe'] == 'CE2 / CM1') {
                        echo ' 
                            <div class="col-6">
                              <div class="row"> 
                                <img src ="./images/'. $data['image'] .'"/>
                              </div>
                              <div class="row d-flex justify-content-center fw-bolder"> '. $data['fonction'] .'</div>
                              <div class="row d-flex justify-content-center text-center"> '. $data['nom'] .' '. $data['prenom'] .'</div>
                            </div>
                            ';
                          } 
                        }
                  ?>
                </div>
            </div> 
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2">
                <h2 class='text-center'>CM1 / CM2</h2>
                <div class="row">
                  <?php
                    // $statement = $db->query('SELECT * FROM parents_delegues ORDER BY fonction DESC');
                    while($data = $statement->fetch()) {
                      if($data['classe'] == 'CM1 / CM2') {
                        echo ' 
                            <div class="col-6 m-auto">
                              <div class="row "> 
                                <img src ="./images/'. $data['image'] .'"/>
                              </div>
                              <div class="row d-flex justify-content-center fw-bolder"> '. $data['fonction'] .'</div>
                              <div class="row d-flex justify-content-center text-center"> '. $data['nom'] .' '. $data['prenom'] .'</div>
                            </div>
                            ';
                          } 
                        }
                  ?>
                </div>
            </div> 
            </div>
        </section>
        <section class="contact d-flex justify-content-sm-evenly align-items-center text-white">
            <h3>Contactez nous</h3>
            <a href="mailto:sandrinekencker@hotmail.com" >Contact</a>
        </section>
    </main>
    <?php 
      require_once 'footer.php';
    ?>
