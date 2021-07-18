
<?php 
  require_once 'database.php';
  require_once 'security.php';
  session_start();

  $db = Database::connect();
  $table  = 'evenement';

  if(Security::verifAccessSession()) {
      
  if(!empty($_GET['id'])) 
    {
    $id = veryfInput ($_GET['id']);
    }
    $isSuccess        = true;
    $isUploadSuccessImage   = false;
    $isUploadSuccessFichier        = false;
    //initilisation des variables
    $image = $imageError = $nameError = $name = $description = $descriptionError = $date = $dateError = $fichier = $shaFileExtImage = $fichierError = "";

    //recupere les donnee de la BDD
    $db = Database::connect();
    $data = selectdata($table, $id, $db);

    $name = $data['nom'];
    $date = $data['date'];
    $description = $data['description'];
    $fichier = $data['fichier'];
    $image = $data['image'];

    // recuperer si changement 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name             = veryfInput($_POST['name']);
        $date            = veryfInput($_POST['date']);
        $description     = veryfInput($_POST['description']);

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

        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
            verifImage($_FILES['image']);
        } else{
            echo $imageError;
        }
        if(isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == 0){
           verifFichier($_FILES['fichier']);
        } else{
            echo $fichierError;
        }

        //si tout va bien tu insert dans la BDD
        if($isSuccess && $isUploadSuccessImage && $isUploadSuccessFichier ) 
        {
            // $db = Database::connect();
            $statement = $db->prepare("UPDATE evenement  set nom = :nom, image = :image, description = :description, date = :date, fichier = :fichier WHERE id = :id");
            $statement->execute(array('nom'=>$name, 'date'=>$date, 'description'=>$description,'image'=>$shaFileExtImage, 'fichier'=>$shaFileExtFichier, 'id'=>$id));
            // Database::disconnect();
            header("Location: connect.php");
        } else if (!$isUploadSuccessImage && $isUploadSuccessFichier) {
            // $db = Database::connect();
            $statement = $db->prepare("UPDATE evenement  set nom = :nom, description = :description, date = :date, fichier = :fichier WHERE id = :id");
            $statement->execute(array('nom'=>$name, 'date'=>$date, 'description'=>$description,'fichier'=>$shaFileExtFichier, 'id'=>$id));
            // Database::disconnect();
            header("Location: connect.php");
        } else if ($isUploadSuccessImage && !$isUploadSuccessFichier) {
            // $db = Database::connect();
            $statement = $db->prepare("UPDATE evenement  set nom = :nom, description = :description, date = :date, image = :image WHERE id = :id");
            $statement->execute(array('nom'=>$name, 'date'=>$date, 'description'=>$description,'image'=>$shaFileExtImage, 'id'=>$id));
            // Database::disconnect();
            header("Location: connect.php");
        } else if ($isSuccess && !$isUploadSuccessImage && !$isUploadSuccessFichier) {
            // $db = Database::connect();
            $statement = $db->prepare("UPDATE evenement  set nom = :nom, description = :description, date = :date WHERE id = :id");
            $statement->execute(array('nom'=>$name, 'date'=>$date, 'description'=>$description, 'id'=>$id));
            // Database::disconnect();
            header("Location: connect.php");
        }
    }
    Database::disconnect();
?>

<!DOCTYPE html>
<html lang="fr">
<?php
    require_once 'headerAdmin.php';
?> 

        <div class="container bg-light d-flex flex-column mt-5 pt-5  align-items-center" style="height: 1000px">
            <h1>Modification de l'evenement "<span class="color:red"> <?php echo $name; ?> </span>"</h1>

            <div class="row">
                <div class="col-12">
                <form action="<?php echo 'update_event.php?id='.$id;?>" method="post" class="form d-flex " role="form" enctype="multipart/form-data">
                        <div>
                            <div class="form-group m-5">
                                <label for="name">Nom :</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                                <span class='help-inline'><?php echo $nameError;
                                

                                ?></span>
                            </div>
                            <div class="form-group m-5">
                                <label for="date">Date :</label>
                                <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo $date; ?>">
                                <span class='help-inline'><?php echo $dateError; ?></span>
                            </div>
                            <div class="form-group m-5 d-flex flex-column">
                                <label for="description">Description :</label>
                                <textarea name="description" id="decription" cols="30" rows="4" value="<?php echo $description; ?>" placeholder = ""><?php echo $description; ?></textarea>
                                <!-- <input type="text" class="form-control" id="description" name="description" placeholder="Description" > -->
                                <span class='help-inline'><?php echo $descriptionError; ?></span>
                            </div>                   
                            <div class="form-group m-5">
                                <label for="fichier">Modifier le fichier :</label>
                                <input type="file" id="fichier" name="fichier" value="<?php echo $fichier; ?>">
                                <span class='help-inline'><?php echo $fichierError; ?></span>
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
                            <iframe id="iframe" width="500" height="300" src="../doc/<?php echo $fichier ?>"> </iframe>
               
                    </form>
                </div>
            </div>
           
        </div>

        <footer class="container-fluid d-flex justify-content-evenly pt-3 bg-light fixed-bottom">
        <p>Copyright © APE Saint-Pierre-de-Lages</p>
    </footer>
    <?php
} else {
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