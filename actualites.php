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
                            $statement = $db->query('SELECT * FROM evenement ORDER BY date DESC', PDO::FETCH_ASSOC);
                            foreach($statement as $row) : ?>
                              <div class="col-lg-6 col-md-12 p-5">
                                    <img class="img img-fluid" src="./images/<?php echo $row['image'] ?>"alt="">
                                </div>
                                <div class="col p-5">
                                    <h2 ><?php echo $row['nom']?></h2>
                                    <hr>
                                    <h4><?php echo date('d / m / Y', strtotime($row['date']))?></h4>
                                    <p><?php echo $row['description'] ?></p>
                                  
                                    <a href="./doc/<?php echo $row['fichier'] ?>"> Document </a>
                                </div>
                                <?php
                              endforeach;
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

