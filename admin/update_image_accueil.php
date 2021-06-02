
<?php 
  require 'database.php';
  
  if(!empty($_GET['id'])) 
  {
    $id = veryfInput ($_GET['id']);
  }


  //initilisation des variables
  $name =  $image = $nameError = $imageError = "";

  if (!empty ($_POST)) {
    $name             = veryfInput($_POST['name']);
    $image            = veryfInput($_FILES['image']['name']);
    $imagePath        = '../images/' . basename($image);
    $imageExtension   =  pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess        = true;


    if(empty($name)) 
    {
        $nameError = 'Ce champ ne peut pas être vide';
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
        if($_FILES["image"]["size"] > 500000) 
        {
            $imageError = "Le fichier ne doit pas depasser les 500KB";
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
          $statement = $db->prepare("UPDATE image_accueil  set nom = ?, image = ? WHERE id = ?");
          $statement->execute(array($name,$image,$id));
      }
      else
      {
          $statement = $db->prepare("UPDATE image_accueil  set nom = ? WHERE id = ?");
          $statement->execute(array($name,$id));
      }
      Database::disconnect();
      header("Location: index.php");
    }
    else if($isImageUpdated && !$isUploadSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM image_accueil where id = ?");
        $statement->execute(array($id));
        $data = $statement->fetch();
        $image = $data['image'];
        Database::disconnect();
      
    }
  }
  else 
  {
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM image_accueil where id = ?");
    $statement->execute(array($id));
    $data = $statement->fetch();
    $name  = $data['nom'];
    $image = $data['image'];
    Database::disconnect();
  }


  //fonction pour verifier l'input 
  function veryfInput ($var) {
    $var = trim($var); //enlever espace etc....
    $var = stripslashes($var); //enlever les \
    $var = htmlspecialchars($var); //enlever le code html etc
    return $var;
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
        <title>APE SPDL</title>
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
                                    <a class="nav-link active" aria-current="page" href="index.html"> Accueil</a>
                                </li>
                                <li class="nav-item me-5">
                                    <a class="nav-link" href="actualites.html">Actualités</a>
                                </li>
                                <li class="nav-item me-5">
                                    <a class="nav-link" href="parents.html">Parents Délégués</a>
                                </li>
                                <li class="nav-item me-5">
                                <a class="nav-link" href="doc.html">Documents</a>
                                </li>
                            
                                <li class="nav-item me-5">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                                
                            </ul>
                            </div>
                    </div>
                </div>
                </nav>
        </header>

        <div class="container bg-light d-flex flex-column justify-content-center align-items-center" style="height: 800px">
            <h1>Modification de l'images "<span class="color:red"> <?php echo $image; ?> </span>"</h1>

            <div class="row">
                <div class="col-6">
                <form action="<?php echo 'update_image_accueil.php?id='.$id;?>" method="post" class="form" role="form" enctype="multipart/form-data">
                <div class="form-group m-5">
                  <label for="name">Nom :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                  <span class='help-inline'><?php echo $nameError; ?></span>
                </div>

                <div class="form-group m-5">
                <label for="">Nom de l'image : </label> 
                <p> <?php echo $image; ?> </p>
                  <label for="image">Selectionner une image :</label>
                  <input type="file" id="image" name="image">
                  <span class='help-inline'><?php echo $imageError; ?></span>
                </div>
              <div class='form-action mt-3 d-flex align-items-center justify-content-center'>
                <button type="submit" class="btn btn-success m-2" >Valider</button>
                <a href="index.php" class="btn btn-primary m-2" >Retour</a>
              </div>
              </form>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <img src="../images/<?php echo $image;?>" alt="... " class="w-50">
                </div>
            </div>
           
        </div>

        <footer class="container-fluid d-flex justify-content-evenly pt-3 bg-light fixed-bottom">
        <p>Copyright © APE Saint-Pierre-de-Lages</p>
    </footer>
    
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