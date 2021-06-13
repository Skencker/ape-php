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
        <section class="baniere-doc d-flex justify-content-center">
            <h1 class="align-self-center">Documents</h1>
        </section>
        <section class="doc d-flex justify-content-center align-items-center">
            <div class="accordion accordion-flush w-50" id="accordionFlushExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordeon accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                     Documents et Bons de commande
                    </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php
                                $statement = $db->query('SELECT * FROM evenement ORDER BY id DESC');                  
                                while($data = $statement->fetch()) {                 
                                    echo '<a href="./doc/'.$data['fichier'].'">'. $data['nom'] .' '. $data['date'] . '</a> </br>';
                                    echo '</br>';
                                }
                            ?>
                        </div>
                    </div>
                  </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordeon accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                      Conseils d'école
                    </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    <?php
                        $statement = $db->query('SELECT * FROM conseils_ecole ORDER BY id DESC');                  
                        while($data = $statement->fetch()) {                 
                            echo '<a href="./doc/'.$data['fichier'].'">'. $data['nom'] ."  " .$data['date'].'</a> </br>';
                            echo '</br>';
                        }
                  ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingThree">
                    <button class=" accordeon accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseTrue">
                      Menus cantine
                    </button>
                  </h2>
                  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <a href="http://www.stpierredelages.fr/SITE/index.php?option=com_content&view=category&id=53&Itemid=88">Menu Mairie</a>
                    </div>
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

