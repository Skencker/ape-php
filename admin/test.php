
<?php 
  require 'database.php';
  require_once 'security.php';
  session_start();

  if(Securite::verifAccessSession()) {

      //fonction pour verifier l'input 
  function veryfInput ($var) {
    $var = trim($var); //enlever espace etc....
    $var = stripslashes($var); //enlever les \
    $var = htmlspecialchars($var); //enlever le code html etc
    return $var;
  };
  
  if(!empty($_GET['id'])) 
    {
    $id = veryfInput ($_GET['id']);
    }

    $isSuccess        = true;
    //initilisation des variables
    $name =  $image = $nameError = $imageError = $date = $dateError = $description = $descriptionError = $fichier = $fichierError = $fichierExtension =  $fichierPath = "";
    // $nameError = $imageError =$dateError = $descriptionError =$fichierError = "";


    // je récupere les nouvelles données
if (!empty ($_POST)) {
    $name             = veryfInput($_POST['name']);
    $date            = veryfInput($_POST['date']);
    $description     = veryfInput($_POST['description']);
    $fichier         = veryfInput($_FILES['fichier']['name']);
    $fichierPath      = '../doc/'. basename($fichier);
    $fichierExtension =  pathinfo($fichierPath, PATHINFO_EXTENSION);
    $image            = veryfInput($_FILES['image']['name']);
    $imagePath        = '../images/' . basename($image);
    $imageExtension   =  pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess        = true;
    
    
    if(empty($name)) 
    {
        $nameError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    
    if(empty($description)) 
    {
        $descriptionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    } 
    if(empty($date)) 
    {
        $dateError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    } 
    
    if(empty($image)) 
    {
        $isImageUpdated = false;
    }
    else
    {
        $isImageUpdated = true;
        $isUploadSuccess = true;
        if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
        {
            $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if(file_exists($imagePath)) 
        {
            $imageError = "Le fichier existe deja";
            $isUploadSuccess = false;
        }
        if($_FILES["image"]["size"] > 5000000) 
        {
            $imageError = "Le fichier ne doit pas depasser les 5000KB";
            $isUploadSuccess = false;
        }
        if($isUploadSuccess) 
        {
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
            {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            } 
        } 
    }
    if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) 
    {
        $db = Database::connect();
        if($isImageUpdated)
        {
            $statement = $db->prepare("UPDATE evenement  set nom = :nom, image = :image, description = :description, date = :date, fichier = :fichier WHERE id = :id");
            $statement->execute(array('nom'=>$name, 'image'=>$image, 'description'=>$description, 'date'=>$date, 'fichier'=>$fichier, 'id'=>$id));
            // $statement->bindValue(':id', $id, 'nom' PDO :: PARAM_INT);  
            $statement->execute();
        }
        else
        {
            $statement = $db->prepare("UPDATE evenement  set nom = :nom, description = :description, date = :date, fichier = :fichier WHERE id = :id");
            $statement->execute(array('nom'=>$name, 'description'=>$description, 'date'=>$date, 'fichier'=>$fichier, 'id'=>$id));
            // $statement->bindValue(':id', $id, 'nom' PDO :: PARAM_INT);  
            $statement->execute();
        }
        Database::disconnect();
        header("Location: connect.php");
    }
    else if($isImageUpdated && !$isUploadSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM evenement where id = :id");
        // $statement->execute(array($id));
        // $data = $statement->fetch();
        $image = $data['image'];
        // Database::disconnect();

        $statement->bindValue(':id', $id, PDO :: PARAM_INT);  
        $statement->execute();
      
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        
    }
}
else 
{
    $db = Database::connect();
 
    $statement = $db->prepare('SELECT * FROM evenement WHERE id = :id');
    $statement->bindValue(':id', $id, PDO :: PARAM_INT);  
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    $name  = $data['nom'];
    $date  = $data['date'];
    $description  = $data['description'];
    $fichier = $data['fichier'];
    $image = $data['image'];

    Database::disconnect();
}

if(empty($fichier)) 
{
    $isFichierUpdated = false;
}
else
{
    $isFichierUpdated = true;
    $isUploadSuccess = true;
    if($fichierExtension != "pdf") 
    {
        $fichierError = "Les fichiers autorises sont: .pdf";
        $isUploadSuccess = false;
    }
    if(file_exists($fichierPath)) 
    {
        $fichierError = "Le fichier existe deja";
        $isUploadSuccess = false;
    }
    // if($_FILES["fichier"]["size"] > 5000000) 
    // {
    //     $fichierError = "Le fichier ne doit pas depasser les 5000KB";
    //     $isUploadSuccess = false;
    // }
    if($isUploadSuccess) 
    {
        if(!move_uploaded_file($_FILES["fichier"]["tmp_name"], $fichierPath)) 
        {
            $fichierError = "Il y a eu une erreur lors de l'upload";
            $isUploadSuccess = false;
        } 
    } 
}
if (($isSuccess && $isFichierUpdated && $isUploadSuccess) || ($isSuccess && !$isFichierUpdated)) 
{
    $db = Database::connect();
    if($isFichierUpdated)
    {
        $statement = $db->prepare("UPDATE evenement  set nom = :nom, image = :image, description = :description, date = :date, fichier = :fichier WHERE id = :id");
        $statement->execute(array('nom'=>$name, 'image'=>$image, 'description'=>$description, 'date'=>$date, 'fichier'=>$fichier, 'id'=>$id));
        // $statement->bindValue(':id', $id, 'nom' PDO :: PARAM_INT);  
        $statement->execute();
    }
    else
    {
        $statement = $db->prepare("UPDATE evenement  set nom = :nom, image = :image, description = :description, date = :date WHERE id = :id");
        $statement->execute(array('nom'=>$name, 'image'=>$image, 'description'=>$description, 'date'=>$date,'id'=>$id));
        // $statement->bindValue(':id', $id, 'nom' PDO :: PARAM_INT);  
        $statement->execute();
    }
    Database::disconnect();
    header("Location: connect.php");
}
else if($isFichierUpdated && !$isUploadSuccess)
{
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM evenement WHERE id = :id');
    $statement->bindValue(':id', $id, PDO :: PARAM_INT);  
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);

    $fichier = $data['fichier'];
    Database::disconnect();
    
}
else 
{
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM evenement WHERE id = :id');
    $statement->bindValue(':id', $id, PDO :: PARAM_INT);  
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    $name  = $data['nom'];
    $date  = $data['date'];
    $description  = $data['description'];
    $fichier = $data['fichierdata'];
    $image = $data['image'];
    Database::disconnect();
}




?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Font google-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"rel="stylesheet" />
    
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap"rel="stylesheet"
        />
        <!--Jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!--Bootstrap-->
        <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
          crossorigin="anonymous"
        />
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
        />

        <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
       
        <link rel="stylesheet" href="../style.css" />
        <title>APE SPDL ADMIN</title>
    </head>
    <body>
        <header class="">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">
                <div class="container-fluid">
                    <a href="#"> 
                        <img class="img img-fluid w-75 ps-3" src="../images/logo.png" alt="logo">
                    </a>
                    <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse lg-d-flex bg-light justify-content-end " id="navbarSupportedContent">
                        <div >
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0  ">
                            <li class="nav-item me-5">
                                    <a class="nav-link border-3" aria-current="page" href="../index.php">Site</a>
                                </li>                               
                                <li class="nav-item me-5">
                                    <a class="nav-link active" aria-current="page" href="connect.php">Gestion admin</a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
                </nav>
        </header>

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
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo $date; ?>">
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