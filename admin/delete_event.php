
<?php 
    require_once 'database.php';
    require_once 'security.php';
    session_start();
    if(Security::verifAccessSession()) {
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();
    $table  = 'evenement';

    if(!empty($_GET['id'])) {
        $idGet = veryfInput($_GET['id']);
        $data = selectdata($table, $idGet, $db);
        $name = $data['nom'];
        $image =$data['image'];
    }
    
    if(!empty($_POST)) {
        $idPost = veryfInput($_POST['id']);
        $databd = selectdata($table, $idPost, $db);
        $imagePost =  "../images/{$databd['image']}";
        $fichierPost =  "../doc/{$databd['fichier']}";
        unlink($imagePost);
        unlink($fichierPost);
        $data = deletdata($table, $idPost, $db);
        header("Location: connect.php"); 
    }   
    Database::disconnect();
?>

<!DOCTYPE html>
<html lang="fr">
<?php
    require_once 'headerAdmin.php';
    ?> 
        <div class="container bg-light d-flex flex-column justify-content-center" style="height: 800px">
        <h1>Supprimer l'évènement</h1>
              <br>
              <form action="delete_event.php" method="post" class="form" role="form">
              <!-- input invisible qui recupere l'id  -->
                <input type="hidden" name="id" value="<?php echo $idGet; ?>"/>
                <p class='alert alert-warning text-dark'>Etes vous sur de vouloir supprimer l'évènement ?</p>
                
          
              <div class='form-action'>
                <button type="submit" class="btn btn-warning m-2" >Oui</button>
                <a href="connect.php" class="btn btn-default m-2" >Non</a>
              </div>
              </form>
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
<script src="app.js"></script>
</html>