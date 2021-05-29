<?php 
    require 'database.php';
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();
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
        <div class="container bg-light p-5 mt-5 ">
            <h1 class='text-center'>Gestion des images du diapo de la page d'accueil</h1>
            <div class="row">
                <h2 class="bold">
                    <a href="insert_image_accueil.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
                </h2>
                <table class="table table-striped table-hover table-primary">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Fichier de l'image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                         
                            // ON RECUPERE LES DONNEES
                            $statement = $db->query('SELECT * FROM image_accueil');
                                
                            //boucle sur toute les lignes de la BDD
                            while($image = $statement->fetch()) {
                                echo ' <tr>
                                    <td>'.$image['nom'].'</td>
                                    <td>'.$image['image'].'</td>
                                    <th class ="action text-center">
                                        <a href="view_image_accueil.php?id=' . $image['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                        <a href="update_image_accueil.php?id=' . $image['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                        <a href="delete_image_accueil.php?id=' . $image['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                    </th>
                                </tr>';
                            };

                            Database::disconnect();
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container bg-light p-5 mt-5 ">
            <h1 class='text-center'>Gestion des événements de la page actualité</h1>
            <div class="row">
                <h2 class="bold">
                    <a href="insert_event.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
                </h2>
                <table class="table table-striped table-hover table-primary">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Date</th>
                            <th>Fichier</th>
                            <th>Image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // ON RECUPERE LES DONNEES
                            $statement = $db->query('SELECT * FROM evenement');
                                
                            //boucle sur toute les lignes de la BDD
                            while($evenement = $statement->fetch()) {
                                echo ' <tr>
                                    <td>'.$evenement['nom'].'</td>
                                    <td>'.$evenement['date'].'</td>
                                    <td>'.$evenement['fichier'].'</td>
                                    <td>'.$evenement['image'].'</td>
                                    <th class ="action text-center">
                                        <a href="view_event.php?id=' . $evenement['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                        <a href="update_event.php?id=' . $evenement['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                        <a href="delete_event.php?id=' . $evenement['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                    </th>
                                </tr>';
                            };
                        
                    
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container bg-light p-5 mt-5 ">
            <h1 class='text-center'>Gestion des parents délégués</h1>
            <div class="row">
                <h2 class="bold">
                    <a href="insert.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
                </h2>
                <table class="table table-striped table-hover table-primary">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Fonction</th>
                            <th>Classe</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // ON RECUPERE LES DONNEES
                            $statement = $db->query('SELECT parents_delegues.id, parents_delegues.nom, parents_delegues.prenom, fonctions_parents_delegues.nom AS fonction, classes.nom AS classe                  FROM parents_delegues 
                                                    LEFT JOIN classes
                                                    ON parents_delegues.classe = classes.id
                                                    LEFT JOIN fonctions_parents_delegues 
                                                    ON parents_delegues.fonction = fonctions_parents_delegues.id
                                                    ');
                                
                            //boucle sur toute les lignes de la BDD
                            while($parents_delegues = $statement->fetch()) {
                                echo ' <tr>
                                    <td>'.$parents_delegues['nom'].'</td>
                                    <td>'.$parents_delegues['prenom'].'</td>
                                    <td>'.$parents_delegues['fonction'].'</td>
                                    <td>'.$parents_delegues['classe'].'</td>
                                    <th class ="action text-center">
                                        <a href="view.php?id=' . $parents_delegues['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                        <a href="update.php?id=' . $parents_delegues['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                        <a href="delete.php?id=' . $parents_delegues['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                    </th>
                                </tr>';
                            };
                        
                    
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container bg-light p-5 mt-5 ">
            <h1 class='text-center'>Gestion des membres de l'APE</h1>
            <div class="row">
                <h2 class="bold">
                    <a href="insert.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
                </h2>
                <table class="table table-striped table-hover table-primary">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Fonction</th>
                 
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // ON RECUPERE LES DONNEES
                            $statement = $db->query('SELECT parents_delegues.id, parents_delegues.nom, parents_delegues.prenom, fonctions_parents_delegues.nom AS fonction                  
                                                    FROM parents_delegues 
                                                    LEFT JOIN fonctions_parents_delegues 
                                                    ON parents_delegues.fonction = fonctions_parents_delegues.id
                                                    ');
                                
                            //boucle sur toute les lignes de la BDD
                            while($parents_delegues = $statement->fetch()) {
                                echo ' <tr>
                                    <td>'.$parents_delegues['nom'].'</td>
                                    <td>'.$parents_delegues['prenom'].'</td>
                                    <td>'.$parents_delegues['fonction'].'</td>
                                    <th class ="action text-center">
                                        <a href="view.php?id=' . $parents_delegues['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                        <a href="update.php?id=' . $parents_delegues['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                        <a href="delete.php?id=' . $parents_delegues['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                    </th>
                                </tr>';
                            };
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container bg-light p-5 mt-5 ">
            <h1 class='text-center'>Gestion des documents</h1>
            <div class="row">
                <h2 class="bold">
                    <a href="insert.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
                </h2>
                <table class="table table-striped table-hover table-primary">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Date</th>
                            <th>Fichier</th>
                 
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // ON RECUPERE LES DONNEES
                            $statement = $db->query('SELECT * FROM document');
                                
                            //boucle sur toute les lignes de la BDD
                            while($document = $statement->fetch()) {
                                echo ' <tr>
                                    <td>'.$document['nom'].'</td>
                                    <td>'.$document['date'].'</td>
                                    <td>'.$document['fichier'].'</td>
                                    <th class ="action text-center">
                                        <a href="view.php?id=' . $document['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                        <a href="update.php?id=' . $document['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                        <a href="delete.php?id=' . $document['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                    </th>
                                </tr>';
                            };
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


                
             
    
    <footer class="container-fluid d-flex justify-content-evenly pt-3 bg-light">
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