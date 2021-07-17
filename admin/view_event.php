
<?php 
    require_once 'database.php';
    require_once 'security.php';
    session_start();
    //recupere l'id de l'image dans URL

    if(Security::verifAccessSession()) {
        
    if(!empty($_GET['id'])) {
        $id = veryfInput($_GET['id']);
      }
      //connection à la basse de donnée
      $db = Database::connect();
  
    $statement = $db->prepare('SELECT * FROM evenement WHERE id = :id');
        $statement->bindValue(':id', $id, PDO :: PARAM_INT);  
        $statement->execute();

  
    $event = $statement->fetch(PDO::FETCH_ASSOC);
    $date = date('d / m / Y', strtotime($event['date']));


    Database::disconnect();
  
    ?>

<!DOCTYPE html>
<html lang="fr">
<?php
    require_once 'headerAdmin.php';
    ?> 

        <div class="container  bg-light p-5 mt-5" >
            <a href="connect.php" class="btn btn-primary mb-5 " > <i class="bi bi-arrow-return-left p-1"></i> Retour</a>
        <div class="row d-flex justify-content-center align-items-center">    
                        <div class="col-lg-6 col-md-12 ">

                            <img class="img img-fluid" src="../images/<?php echo  $event['image'] ?>"alt="">
                        </div>
                        <div class="col p-5">
                            <h2 ><?php echo  $event['nom']?></h2>
                            <hr>
                            <h4><?php echo $date; ?></h4>
                            <p><?php echo  $event['description'] ?></p>
                        </div>
                            <iframe id="iframe" width="500" height="300" src="../doc/<?php echo $event['fichier'] ?>"> </iframe>
                        
                </div>
        </div>
        </div>

        <footer class="container-fluid d-flex justify-content-evenly pt-3 bg-light fixed-bottom">
        <p>Copyright © APE Saint-Pierre-de-Lages</p>
    </footer>
    <?php
}else {
    header('location: connect.php');
}
        
?>
</body>
 <!--Bootstrap-->
 <script
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
 crossorigin="anonymous"
></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <script src="app.js"></script> -->
</html>