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
        <section class="parents container-fluid d-flex align-items-center justify-content-center mt-5">
          <div class="row d-flex justify-content-center align-items-start">
          <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){
                      if($parents['classe'] == 'PS') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'PS') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
              <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'PS / MS') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'PS / MS') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
                 <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'MS') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'MS') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
                 <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'MS / GS') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'MS / GS') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
                 <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'GS') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'GS') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
              <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'GS / CP') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'GS / CP') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
                 <?php
                      $statement = $db->query('SELECT * FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'CP') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'CP') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
              <?php
                      $statement = $db->query('SELECT * FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'CP / CE1') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'CP / CE1') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
                 <?php
                      $statement = $db->query('SELECT * FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'CE1') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'CE1') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
                 <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'CE2') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'CE2') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
              <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'CE2 / CM1') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'CE2 / CM1') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
                 <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'CM1') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'CM1') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
              <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'CM1 / CM2') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'CM1 / CM2') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
                 <?php
                      $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                      while($parents = $statement->fetch(PDO::FETCH_ASSOC)){

                     
                      if($parents['classe'] == 'CM2') {
              ?>
                          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                              <div class="row">
                              <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                                <?php
                                    $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                                    foreach ($statement as $row) : 
                                      if($row['classe'] == 'CM2') {
                                        ?>
                                
                                    <div class="col-6">
                                      <div class="row"> 
                                        <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                                      </div>
                                      <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                                      <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                                    </div>
                <?php
                                    } 
                                  endforeach;
                ?>
                                </div>
                              </div>
                <?php
                      } else {
                          echo '';
                       }
                      };
                ?>
      
             
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
