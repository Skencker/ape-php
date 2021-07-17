
<?php 

require_once 'database.php';
require_once 'security.php';
session_start();
    
    if(Security::verifAccessSession()) {
        
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();
      //fonction pour verifier l'input 
//   function veryfInput ($var) {
//     $var = trim($var); //enlever espace etc....
//     $var = stripslashes($var); //enlever les \
//     $var = htmlspecialchars($var); //enlever le code html etc
//     return $var;
//   };

    if(!empty($_GET['id'])) {
        $id = veryfInput($_GET['id']);
        $statement = $db->prepare("SELECT * FROM parents_delegues where id = :id");
        $statement->bindValue(':id', $id);  
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $name = $data['nom'];
        $image =$data['image'];
        unlink("../images/$image");
        Database::disconnect();
    }
    
    if(!empty($_POST)) {
        $id = veryfInput($_POST['id']);
        $db = Database::connect();
        
        $statement = $db->prepare("DELETE FROM parents_delegues WHERE id = :id");
        $statement->bindValue(':id', $id); 
        $statement->execute(); 
        $data = $statement->fetch(PDO::FETCH_ASSOC);
 
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
        <h1>Supprimer le parent délégué</h1>
              <br>
              <form action="delete_parent.php" method="post" class="form" role="form">
              <!-- input invisible qui recupere l'id  -->
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <p class='alert alert-warning text-dark'>Etes vous de vouloir supprimer :"  <?php echo $name; ?>. " ?</p>
                
          
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