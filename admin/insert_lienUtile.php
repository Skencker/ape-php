<?php
require_once 'database.php';
require_once 'security.php';
//connection a la fonction statique (::) de la bdd 
$db = Database::connect();

session_start();

//fonction pour verifier l'input 
// function veryfInput($var)
// {
//     $var = trim($var); //enlever espace etc....
//     $var = stripslashes($var); //enlever les \
//     $var = htmlspecialchars($var); //enlever le code html etc
//     return $var;
// }

if(Security::verifAccessSession()) {


//initilisation des variables. 
// AJOUT DE VARIABLES $nbParentDelPerClass, $nbParentDelPerClassError
$name  = $href = $hrefError = $nameError = "";

if (!empty($_POST)) {
    $name            = veryfInput($_POST['name']);
    $href         = veryfInput($_POST['href']);
    $isSuccess       = true;

    if (empty($name)) {
        $nameError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($href)) {
        $hrefError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
  
    //si tout va bien tu insert dans la BDD
    if ($isSuccess) {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO lienUtile (nom, href) values(:nom, :href)");
        $statement->execute(array(
            'nom'=>$name,
            'href'=>$href
        ));
        Database::disconnect();
        header("Location: connect.php");
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<?php
    require_once 'headerAdmin.php';
    ?> 
        <div class="container bg-light d-flex flex-column justify-content-center align-items-center" style="height: 800px">
            <h1>Ajouter un lien</h1>

            <form action="insert_lienUtile.php" method="post" class="form" role="form">
                <div class="form-group m-5">
                  <label for="name">Nom :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                  <span class='help-inline'><?php echo $nameError; ?></span>
                </div>
                <div class="form-group m-5">
                  <label for="href">Lien du site : </label>
                  <input type="text" class="form-control" id="href" name="href" placeholder="https://wwww.123456.fr " value="<?php echo $href; ?>">
                  <span class='help-inline'><?php echo $hrefError; ?></span>
                </div>
      
                
          
              <div class='form-action m-5'>
                <button type="submit" class="btn btn-success m-2" >Valider</button>
                <a href="connect.php" class="btn btn-primary m-2" >Retour</a>
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