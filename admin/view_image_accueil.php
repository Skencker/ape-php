
<?php 
    require_once 'database.php';
    require_once 'security.php';
    
	session_start();

if(Security::verifAccessSession()) {
    //connection à la basse de donnée
    $db = Database::connect();
    $table  = 'image_accueil';


    //recupere l'id de l'image dans URL
    if(!empty($_GET['id'])) {
        $id = veryfInput($_GET['id']);
        $data = selectdata($table, $id, $db);
      }

    Database::disconnect();

  
?>

<!DOCTYPE html>
<html lang="fr">
<?php
    require_once 'headerAdmin.php';
    ?> 
        <div class="container d-flex justify-content-center align-items-center bg-light p-5 mt-5" style="height: 800px" >
        <img src="../images/<?php echo  $data['image'] ?>" alt="... " class="w-50">
        <div>
            <a href="connect.php" class="btn btn-primary m-2" > <i class="bi bi-arrow-return-left p-1"></i> Retour </a>
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
<script src="app.js"></script>
</html>

