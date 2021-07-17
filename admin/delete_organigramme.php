
<?php 
    require_once 'database.php';
    require_once 'security.php';
    session_start();

    if(Security::verifAccessSession()) {
            
        //fonction pour sécurisé les données
        //   function veryfInput ($data) {
        //     $data = trim($data);
        //     $data = stripcslashes($data);
        //     $data = htmlspecialchars($data);
        //     return $data;
        //   }
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();

    if(!empty($_GET['id'])) {
        $id = veryfInput($_GET['id']);
        $statement = $db->prepare("SELECT * FROM organigramme where id = :id");
        $statement->bindParam(':id', $id);  
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $fichier =$data['fichier'];
        Database::disconnect();
    }
    
    if(!empty($_POST)) {
        $id = veryfInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM organigramme WHERE id = :id");
        $statement->bindParam(':id', $id); 
        $statement->execute(); 
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $fichier =$data['fichier'];
        unlink("../doc/organigramme/$fichier");
        Database::disconnect();
        header("Location: connect.php"); 
    }



?>

<!DOCTYPE html>
<html lang="fr">
<?php
    require_once 'headerAdmin.php';
    ?> 
        <div class="container bg-light d-flex flex-column justify-content-center" style="height: 800px">
        <h1>Supprimer un organigramme</h1>
        <?php
            // var_dump($suppr);
        ?>
              <br>
              <form action="delete_organigramme.php" method="post" class="form" role="form">
              <!-- input invisible qui recupere l'id  -->
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <p class='alert alert-warning text-dark'>Etes vous sur de vouloir supprimer le fichier ?</p>
                
          
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