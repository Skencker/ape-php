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
        <section class="baniere-actualites d-flex justify-content-center">
            <h1 class="align-self-center ">Actualités</h1>
        </section>
        <section class="events">
            <div class="container">
                <div class="row event">
                  <?php
                            $statement = $db->query('SELECT * FROM evenement ORDER BY id DESC');
                            while ($even = $statement->fetch()) {
                              echo '
                              <div class="col-lg-6 col-md-12 p-5">
                                    <img class="img img-fluid" src="./images/'. $even['image'] .  '"alt="">
                                </div>
                                <div class="col p-5">
                                    <h2 >'. $even['nom'].'</h2>
                                    <hr>
                                    <h4>'. $even['date'] . '</h4>
                                    <p>'. $even['description'] . '</p>
                                  
                                    <a href="./doc/'. $even['fichier'] . '"> Document </a>
                                </div>';
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

