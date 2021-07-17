
<?php 
    require_once 'database.php';
    require_once 'security.php';

    session_start();

    if(Security::verifAccessSession()) {
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();



      //initilisation des variables
  $fichier = $fichierError = $nameError = $name = $date = $dateError = "";



    // Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = veryfInput($_POST['name']);
    $date = veryfInput($_POST['date']);
    // $image = veryfInput($_FILES['image']['name']);
    if(empty($name)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
    if(empty($date)) 
        {
            $dateError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
    // if(empty($image)) 
    //     {
    //         $imageError = 'Ce champ ne peut pas être vide';
    //         $isSuccess = false;
    //     }
    // Vérifie si le fichier a été uploadé sans erreur.
    if(isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == 0){
        $allowed = array("pdf" => "application/pdf", "doc" => "application/doc", "docs" => "application/docs", "text" => "application/text",  "png" => "image/png");
        $filename = $_FILES["fichier"]["name"];
        $filetype = $_FILES["fichier"]["type"];
        $filesize = $_FILES["fichier"]["size"];

        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) 
            $imageError = 'Veuillez sélectionner un format de fichier valide.';

        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) 
            $imageError = 'La taille du fichier est supérieure à la limite autorisée.';

        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
            // Vérifie si le fichier existe avant de le télécharger.
                $shaFile = hash('sha256', $_FILES["fichier"]["name"]);

                $shaFileExtFichier = $shaFile . "." . array_search($filetype, $allowed);
           
                move_uploaded_file($_FILES["fichier"]["tmp_name"], "../doc/organigramme/" . $shaFileExtFichier);
                echo "Votre fichier a été téléchargé avec succès.";
                $isSuccess = true;
                $isUploadSuccess = true;
            
        } else{
            echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
        }
    } else{
        echo $nameError;
    }
}

    //si tout va bien tu insert dans la BDD
    if($isSuccess && $isUploadSuccess) 
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO organigramme (nom, date, fichier) values(:nom, :date, :fichier)");
        $statement->execute(array('nom'=>$name, 'date'=>$date, 'fichier'=>$shaFileExtFichier));
        Database::disconnect();
        header("Location: connect.php");
    }

?>

<!DOCTYPE html>
<html lang="fr">
<?php
    require_once 'headerAdmin.php';
    ?> 

        <div class="container bg-light d-flex flex-column justify-content-center align-items-center" style="height: 800px">
            <h1>Ajouter un organigramme</h1>
                   <form action="insert_organigramme.php" method="post" class="form" role="form" enctype="multipart/form-data">
                <div class="form-group m-5">
                  <label for="name">Nom :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                  <span class='help-inline'><?php echo $nameError; ?></span>
                </div>
                <div class="form-group m-5">
                  <label for="date">Date :</label>
                  <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo $date; ?>">
                  <span class='help-inline'><?php echo $dateError; ?></span>
                </div>

                <div class="form-group m-5">
                  <label for="fichier">Selectionner un fichier : format .pdf</label>
                  <br>
                  <input type="file" id="fichier" name="fichier">
                  <span class='help-inline'><?php echo $fichierError; ?></span>
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