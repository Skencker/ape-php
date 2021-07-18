<?php
require_once 'database.php';
require_once 'security.php';
//connection a la fonction statique (::) de la bdd 
$db = Database::connect();

session_start();

if(Security::verifAccessSession()) {


//initilisation des variables. 
// AJOUT DE VARIABLES $nbParentDelPerClass, $nbParentDelPerClassError
$image = $imageError = $nameError = $name = $fonction = $fonctionError = $prenom = $prenomError = $classe = $classeError = $nbParentDelPerClass = $shaFileExt = $nbParentDelPerClassError = "";

$isSuccess = true;
$isUploadSuccessImage = false;

// Récupère le type de classe par défaut : "PS / MS"
$typeClasse = $_POST['classe'];

// Compte le nombre de délégués déjà présent dans $typeClass
$reponse = $db->query("SELECT COUNT(*) AS nbParentDelPerClass FROM parents_delegues WHERE classe='$typeClasse'");

// Incrémente $nbParentDelPerClass
while ($donnees = $reponse->fetch()) {
    $nbParentDelPerClass = $donnees['nbParentDelPerClass'];
}

if (!empty($_POST)) {
    $name            = veryfInput($_POST['name']);
    $prenom          = veryfInput($_POST['prenom']);
    $classe          = veryfInput($_POST['classe']);
    $fonction        = veryfInput($_POST['fonction']);
    $image           = veryfInput($_FILES['image']['name']);
    $imagePath       = '../images/' . basename($image);
    $imageExtension  = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess       = true;
    $isUploadSuccess = true;
    
    // Vérification de la condition du nombre de parents délégués
    if ($nbParentDelPerClass > 1) {
        $nbParentDelPerClassError = 'Il y a déjà 2 parents délégués pour cette classe';
        $isSuccess = false;
    }
    if (empty($name)) {
        $nameError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($prenom)) {
        $prenomError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($fonction)) {
        $fonctionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($classe)) {
        $classeError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(isset($_FILES["files"]) && $_FILES["files"]["error"] == 0){
        verifImage($_FILES['files']);
    } else{
        echo $imageError;
    }
    
    //si tout va bien tu insert dans la BDD
    if ($isSuccess && $isUploadSuccessImage) {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO parents_delegues (nom, prenom, fonction, classe, image) values(:nom, :prenom, :fonction, :classe, :image)");
        $statement->execute(array(
            'nom'=>$name,
            'prenom'=>$prenom,
            'fonction'=>$fonction,
            'classe'=>$classe,
            'image'=>$shaFileExtImage
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
            <h1>Ajouter un parent délégué</h1>
            <span class='help-inline'><?php echo $nbParentDelPerClassError; ?></span>

            <form action="insert_parent.php" method="post" class="form" role="form" enctype="multipart/form-data">
                <div class="form-group m-5">
                  <label for="name">Nom :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                  <span class='help-inline'><?php echo $nameError; ?></span>
                </div>
                <div class="form-group m-5">
                  <label for="prenom">Prénom :</label>
                  <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" value="<?php echo $prenom; ?>">
                  <span class='help-inline'><?php echo $prenomError; ?></span>
                </div>
      
                <div class="form-group m-5">
                  <label for="fonction">Fonction : </label>
                  <select class="form-control" id = "fonction" name="fonction">
                      <option value='Titulaire'>Titulaire</option>
                      <option value='Suppléant'>Suppléant</option>
                  </select>
                  <span class='help-inline'><?php echo $fonctionError; ?></span>
                </div>
                <div class="form-group m-5">
                  <label for="classe">Classe :</label>
                  <select class="form-control" id = "classe" name="classe">
                      <option value='PS'>PS</option>
                      <option value='PS / MS'>PS / MS</option>
                      <option value='MS'>MS</option>
                      <option value='MS / GS'>MS / GS</option>
                      <option value='GS'>GS</option>
                      <option value='GS / CP'>GS / CP</option>
                      <option value='CP'>CP</option>
                      <option value='CP / CE1'>CP / CE1</option>
                      <option value='CE1'>CE1</option>
                      <option value='CE1 / CE2'>CE1 / CE2</option>
                      <option value='CE2'>CE2</option>
                      <option value='CE2 / CM1'>CE2 / CM1 </option>
                      <option value='CM1'>CM1 </option>
                      <option value='CM1 / CM2'>CM1 / CM2</option>
                      <option value='CM2'>CM2</option>
                  </select>
                  <span class='help-inline'><?php echo $classeError; ?></span>
                </div>
         

                <div class="form-group m-5">
                  <label for="files">Selectionner une image :</label>
                  <input type="file" id="files" name="files">
                  <span class='help-inline'><?php echo $imageError; ?></span>
                </div>


          
              <div class='form-action m-5'>
                <button type="submit" class="btn btn-success w-25 m-2" >Valider</button>
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