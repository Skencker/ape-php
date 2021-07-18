
<?php 
  require_once 'database.php';
  require_once 'security.php';
  session_start();

  if(Security::verifAccessSession()) {
  
  if(!empty($_GET['id'])) 
    {
    $id = veryfInput ($_GET['id']);
    }
    $isSuccess        = true;
    $isUploadSuccessImage        = false;
    //initilisation des variables
    $image = $imageError = $nameError = $name = $prenom = $prenomError = $fonction = $fonctionError = $classe  = $classeError  = $shaFileExtImage = "";
    $table  = 'parents_delegues';
    //recupere les donnee de la BDD
    $db = Database::connect();
    $data = selectdata($table, $id, $db);

    $name = $data['nom'];
    $prenom = $data['prenom'];
    $classe = $data['classe'];
    $fonction = $data['fonction'];
    $image = $data['image'];

    // recuperer si changement 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name             = veryfInput($_POST['name']);
        $prenom            = veryfInput($_POST['prenom']);
        $classe   = veryfInput($_POST['classe']);
        $fonction   = veryfInput($_POST['fonction']);

        if(empty($name)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($prenom)) 
        {
            $prenomError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($classe)) 
        {
            $classeError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }

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
                    $isSuccessImage = true;
                    $isUploadSuccessImage = true;
                
            } else{
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
            }
        } else{
            echo $imageError;
        }
        
        //si tout va bien tu insert dans la BDD
        if($isSuccess && $isUploadSuccessImage ) 
        {
            $db = Database::connect();
            $statement = $db->prepare("UPDATE parents_delegues  set nom = :nom, prenom = :prenom, classe = :classe, fonction = :fonction, image = :image WHERE id = :id");
            $statement->execute(array('nom'=>$name, 'prenom'=>$prenom, 'classe'=>$classe,'image'=>$shaFileExtImage, 'fonction'=>$fonction, 'id'=>$id));
            Database::disconnect();
            header("Location: connect.php");
        } else if (!$isUploadSuccessImage && $isSuccess) {
            $db = Database::connect();
            $statement = $db->prepare("UPDATE parents_delegues  set nom = :nom, prenom = :prenom, classe = :classe, fonction = :fonction WHERE id = :id");
            $statement->execute(array('nom'=>$name, 'prenom'=>$prenom, 'classe'=>$classe, 'fonction'=>$fonction, 'id'=>$id));
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

        <div class="container bg-light d-flex flex-column mt-5 pt-5  align-items-center" style="height: 1000px">
            <h1>Modification du parent délégué "<span class="color:red"> <?php echo $prenom; ?> -  <?php echo $name;?>  </span>"</h1>

            <div class="row">
                <div class="col-12">
                <form action="<?php echo 'update_parent.php?id='.$id;?>" method="post" class="form d-flex " role="form" enctype="multipart/form-data">
                        <div>
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
                            <div class="form-group m-5 d-flex flex-column">
                                <label for="classe">Classe : (Ex : PS / MS ou CP )</label>
                                <input type="text" class="form-control" id="classe" name="classe" placeholder="Classe" value="<?php echo $classe; ?>">
                                <span class='help-inline'><?php echo $classeError; ?></span>
                            </div>                   
                            <div class="form-group m-5 d-flex flex-column">
                                <label for="fonction">Fonction : Titulaire ou Suppléant (avec une majuscule) </label>
                                <input type="text" class="form-control" id="fonction" name="fonction" placeholder="Fonction" value="<?php echo $fonction; ?>">
                                <span class='help-inline'><?php echo $fonctionError; ?></span>
                            </div>                   
                 
                            <div class="form-group m-5">
                                <label for="image">Modifier l'image :</label>
                                <input type="file" id="image" name="image" value="<?php echo $image; ?>">
                                <span class='help-inline'><?php echo $imageError; ?></span>
                            </div>
                            <div class='form-action mt-3 d-flex align-items-center justify-content-center pb-5'>
                                <button type="submit" class="btn btn-success m-2" >Valider</button>
                                <a href="connect.php" class="btn btn-primary m-2" >Retour</a>
                            </div>
                        </div>
                        <img src="../images/<?php echo $image;?>" alt="... " class="w-50">
                    </form>
                </div>
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
<!-- <script src="app.js"></script> -->
</html>