
<?php 

session_start();
    require 'database.php';
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();

    if(!empty($_GET['id'])) {
        $id = veryfInput($_GET['id']);
        $statement = $db->prepare("SELECT * FROM parents_delegues where id = :id");
        $statement->bindValue(':id', $id, PDO :: PARAM_INT);  
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $name = $data['nom'];
        $image =$data['image'];
        unlink("../images/$image");
        Database::disconnect();
    }
    
    if(!empty($_POST)) {
        $id = veryfInput($_POST['id']);
        $db = Database::connect();
        
        $statement = $db->prepare("DELETE FROM parents_delegues WHERE id = :id");
        $statement->bindValue(':id', $id, PDO :: PARAM_INT); 
        $statement->execute(); 
        $data = $statement->fetch(PDO::FETCH_ASSOC);
 
        Database::disconnect();
        header("Location: connect.php");
    }

  //fonction pour verifier l'input 
  function veryfInput ($var) {
    $var = trim($var); //enlever espace etc....
    $var = stripslashes($var); //enlever les \
    $var = htmlspecialchars($var); //enlever le code html etc
    return $var;
  };

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
        <div class="container bg-light d-flex flex-column justify-content-center" style="height: 800px">
        <h1>Supprimer le parent délégué</h1>
              <br>
              <form action="delete_parent.php" method="post" class="form" role="form">
              <!-- input invisible qui recupere l'id  -->
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <p class='alert alert-warning text-dark'>Etes vous de vouloir supprimer :"  <?php echo $name; ?>. " ?</p>
                
          
              <div class='form-action'>
                <button type="submit" class="btn btn-warning m-2" >Oui</button>
                <a href="connect.php" class="btn btn-default m-2" >Non</a>
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