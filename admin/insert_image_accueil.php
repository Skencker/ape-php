
<?php 
    require_once 'database.php';
    require_once 'security.php';
	session_start();

      //fonction pour verifier l'input 
//   function veryfInput ($var) {
//     $var = trim($var); //enlever espace etc....
//     $var = stripslashes($var); //enlever les \
//     $var = htmlspecialchars($var); //enlever le code html etc
//     return $var;
//   };

    if(Security::verifAccessSession()) {
        

    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();


      //initilisation des variables
  $image = $imageError = $nameError = $name = $shaFileExt = "";

  


    // Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = veryfInput($_POST['name']);
    // $image = veryfInput($_FILES['image']['name']);
    if(empty($name)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
    // Vérifie si le fichier a été uploadé sans erreur.
    if(isset($_FILES["files"]) && $_FILES["files"]["error"] == 0){
        $allowed = array("jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["files"]["name"];
        $filetype = $_FILES["files"]["type"];
        $filesize = $_FILES["files"]["size"];

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
                $shaFile = hash('sha256', $_FILES["files"]["name"]);

                $shaFileExt = $shaFile . "." . array_search($filetype, $allowed);
           
                move_uploaded_file($_FILES["files"]["tmp_name"], "../images/" . $shaFileExt);
                echo "Votre fichier a été téléchargé avec succès.";
                $isSuccess = true;
                $isUploadSuccess = true;
            
        } else{
            echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
        }
    } else{
        echo $imageError;
    }
}

    //si tout va bien tu insert dans la BDD
    if($isSuccess && $isUploadSuccess) 
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO image_accueil (nom, image) values(:nom, :image)");
        $statement->execute(array('nom'=>$name, 'image'=>$shaFileExt));
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
            <h1>Ajouter des images au diapo de la page d'accueil</h1>

            <form action="insert_image_accueil.php" method="post" class="form" role="form" enctype="multipart/form-data">
                <div class="form-group m-5">
                  <label for="name">Nom :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                  <span class='help-inline'><?php echo $nameError; ?></span>
                </div>

                <div class="form-group m-5">
                  <label for="files">Selectionner une image : <br> (Photo en mode paysage et en jpg).</label>
                  <br>
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