
<?php 
    require_once 'database.php';
    require_once 'security.php';
    session_start();

    if(Security::verifAccessSession()) {
        //recupere l'id de l'image dans URL
        if(!empty($_GET['id'])) {
        $id = veryfInput($_GET['id']);
    }
      //connection à la basse de donnée
        $db = Database::connect();
        $statement = $db->prepare('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues WHERE id = :id ');
        $statement->bindValue(':id', $id, PDO :: PARAM_INT); 
        $statement-> execute(); 
        $parent = $statement->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    

  
    ?>

<!DOCTYPE html>
<html lang="fr">
<?php
    require_once 'headerAdmin.php';
    ?> 

        <div class="container  bg-light p-5 mt-5" style="height: 800px" >
            <a href="connect.php" class="btn btn-primary mb-5 " > <i class="bi bi-arrow-return-left p-1"></i> Retour</a>
        <div class="row d-flex justify-content-center align-items-center">
                          <div class="col-lg-6 col-md-12 ">
                            <img class="img img-fluid" src="../images/<?php echo $parent['image'] ?> "alt="">
                        </div>
                        <div class="col p-5">
                            <h2 > Nom : <?php echo $parent['nom'] ?></h2>
                            <h2 > Prénom :  <?php echo $parent['prenom']?></h2>
                            <hr>
                            <h4 > Fonction :  <?php echo $parent['fonction'] ?></h4>
                            <p > Classe :  <?php echo $parent['classe'] ?></p>
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