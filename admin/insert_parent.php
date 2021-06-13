<?php
require 'database.php';
//connection a la fonction statique (::) de la bdd 
$db = Database::connect();

//initilisation des variables. 
// AJOUT DE VARIABLES $nbParentDelPerClass, $nbParentDelPerClassError
$image = $imageError = $nameError = $name = $fonction = $fonctionError = $prenom = $prenomError = $classe = $classeError = $nbParentDelPerClass = $nbParentDelPerClassError = "";

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
    
    //si tout va bien tu insert dans la BDD
    if ($isSuccess && $isUploadSuccess) {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO parents_delegues (nom, prenom, fonction, classe, image) values(?, ?, ?, ?, ?)");
        $statement->execute(array(
            $name,
            $prenom,
            $fonction,
            $classe,
            $shaFileExt
        ));
        Database::disconnect();
        header("Location: connect.php");
    }
}

//fonction pour verifier l'input 
function veryfInput($var)
{
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
                      <option value='PS / MS'>PS / MS</option>
                      <option value='GS / CP'>GS / CP</option>
                      <option value='CP / CE1'>CP / CE1</option>
                      <option value='CE2 / CM1'>CE2 / CM1 </option>
                      <option value='CM1 / CM2'>CM1 / CM2</option>
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