
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
  $image = $imageError = $nameError = $name = $description = $descriptionError = $date = $dateError = $fichier = $shaFileExtImage = $fichierError = "";

    // Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = veryfInput($_POST['name']);
    $date = veryfInput($_POST['date']);
    $description = veryfInput($_POST['description']);
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
    if(empty($description)) 
        {
            $descriptionError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
    // if(empty($image)) 
    //     {
    //         $imageError = 'Ce champ ne peut pas être vide';
    //         $isSuccess = false;
    //     }
    // Vérifie si le fichier a été uploadé sans erreur.
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
        $allowed = array("jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];

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
                $shaFile = hash('sha256', $_FILES["image"]["name"]);

                $shaFileExtImage = $shaFile . "." . array_search($filetype, $allowed);
           
                move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $shaFileExtImage);
                echo "Votre fichier a été téléchargé avec succès.";
                $isSuccess = true;
                $isUploadSuccess = true;
            
        } else{
            echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
        }
    } else{
        echo $imageError;
    }
    if(isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == 0){
        $allowed = array("pdf" => "application/pdf", "doc" => "application/doc", "docs" => "application/docs", "text" => "application/text");
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

                $shaFileExtFichier = $shaFile . "." . $ext;
           
                move_uploaded_file($_FILES["fichier"]["tmp_name"], "../doc/" . $shaFile . "." . array_search($filetype, $allowed));
                echo "Votre fichier a été téléchargé avec succès.";
                $isSuccess = true;
                $isUploadSuccess = true;
            
        } else{
            echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
        }
    } else{
        echo $fichierError;
    }
    //si tout va bien tu insert dans la BDD
    if($isSuccess && $isUploadSuccess) 
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO evenement (nom, date, description, image, fichier) values(:nom, :date, :description, :image, :fichier)");
        $statement->execute(array('nom'=>$name, 'date'=>$date, 'description'=>$description,'image'=>$shaFileExtImage, 'fichier'=>$shaFileExtFichier));
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
        <div class="container bg-light d-flex flex-column justify-content-center align-items-center mt-5 pt-5" style="height: 800px">
            <h1 class="mt-5 pt-5">Ajouter un évèvement</h1>
            <form action="insert_event.php" method="post" class="form" role="form" enctype="multipart/form-data">
                <div class="form-group m-5">
                  <label for="name">Nom :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                  <span class='help-inline'><?php echo $nameError; ?></span>
                </div>
                <div class="form-group m-5">
                  <label for="date">Date :</label>
                  <input type="date" class="form-control" id="date" name="date" placeholder="date" value="<?php echo $date; ?>">
                  <span class='help-inline'><?php echo $dateError; ?></span>
                </div>
                <div class="form-group m-5">
                  <label for="description">Description:</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                  <span class='help-inline'><?php echo $descriptionError; ?></span>
                </div>

                <div class="form-group m-5">
                  <label for="image">Selectionner une image : format .jpg</label>
                  <br>
                  <br>
                  <input type="file" id="image" name="image">
                  <span class='help-inline'><?php echo $imageError; ?></span>
                </div>
                <div class="form-group m-5">
                  <label for="fichier">Selectionner une fichier : format .pdf</label>
                  <br>
                  <br>
                  <input type="file" id="fichier" name="fichier">
                  <span class='help-inline'><?php echo $fichierError; ?></span>
                </div>


          
              <div class='form-action m-5'>
                <button type="submit" class="btn btn-success m-2 w-25" >Valider</button>
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