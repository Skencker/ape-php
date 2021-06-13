
<?php

    session_start();

    require('database.php');

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        //ADRESS EMAIL SYNTAXE

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: connect.php?error=1&message=Votre adresse email est invalide');
            exit();
        }

        // CHIFFRAGE DU MOT DE PASSE
        $password = "aq1".sha1($password."123")."25";

        // EMAIL DEJA UTILISE
        $req = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = ?");
        $req->execute(array($email));

        while($email_verification = $req->fetch()){
            if($email_verification['numberEmail'] != 1){
                header('location: connect.php?error=1&message=Impossible de vous authentifier correctement.');
                exit();
            }
        }

        // CONNEXION
        $req = $db->prepare("SELECT * FROM user WHERE email = ?");
        $req->execute(array($email));

        while($user = $req->fetch()){
            if($password == $user['password']){
                $_SESSION['connect'] = 1;
                $_SESSION['email']   = $user['email'];
                if(isset($_POST['auto'])){
                    setcookie('auth', $user['secret'], time() + 364*24*3600, '/', null, false, true);
                }
                header('location: connect.php?success=1');
                exit();
            }
            else {
                header('location: connect.php?error=1&Impossible de vous authentifier correctement.');
                exit();
            }
        }
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
    
                    <div class="collapse navbar-collapse lg-d-flex justify-content-end " id="navbarSupportedContent">
                        <div >
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0  ">
                                <li class="nav-item me-5">
                                    <a class="nav-link border-3" aria-current="page" href="../index.php">Site</a>
                                </li>                               
                                <li class="nav-item me-5">
                                    <a class="nav-link active" aria-current="page" href="connect.php">Gestion admin</a>
                                </li>                               
                                <li class="nav-item me-5">
                                    <a class="nav-link" aria-current="page" href="logout.php">Deconnexion</a>
                                </li>                               
                            </ul>
                        </div>
                    </div>
                </div>
                </nav>
    </header>
    <section class='connexion'>
        <?php 

            if(isset($_SESSION['connect'])) {
        ?>
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
                                                <th class ="action text-center">
                                                    <a href="view_image_accueil.php?id=' . $image['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                                    <a href="delete_image_accueil.php?id=' . $image['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                                    </th>
                                                    </tr>';
                                                };
                                                // <a href="update_image_accueil.php?id=' . $image['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>

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
                                        <!-- <th>Fichier</th>
                                        <th>Image</th> -->
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
                                                <th class ="action text-center">
                                                <a href="view_event.php?id=' . $evenement['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                                <a href="delete_event.php?id=' . $evenement['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                                </th>
                                                </tr>';
                                            };
                                            // <td>'.$evenement['fichier'].'</td>
                                            // <td>'.$evenement['image'].'</td>
                                            // <a href="update_event.php?id=' . $evenement['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                            
                                
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
                                <a href="insert_parent.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
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
                                        $statement = $db->query('SELECT * FROM parents_delegues 
                                                        ');
                                            
                                        //boucle sur toute les lignes de la BDD
                                        while($parents_delegues = $statement->fetch()) {
                                            echo ' <tr>
                                                <td>'.$parents_delegues['nom'].'</td>
                                                <td>'.$parents_delegues['prenom'].'</td>
                                                <td>'.$parents_delegues['fonction'].'</td>
                                                <td>'.$parents_delegues['classe'].'</td>
                                                <th class ="action text-center">
                                                    <a href="view_parent.php?id=' . $parents_delegues['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                                    <a href="delete_parent.php?id=' . $parents_delegues['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                                    </th>
                                                    </tr>';
                                                };
                                                // <a href="update_parent.php?id=' . $parents_delegues['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                    
                                
                                        Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
          
                    <div class="container bg-light p-5 mt-5 ">
                        <h1 class='text-center'>Gestion de l'organigramme</h1>
                        <div class="row">
                            <h2 class="bold">
                                <a href="insert_organigramme.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
                            </h2>
                            <table class="table table-striped table-hover table-primary">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        // ON RECUPERE LES DONNEES
                                        $statement = $db->query('SELECT * FROM organigramme');
                                            
                                        //boucle sur toute les lignes de la BDD
                                        while($organigramme = $statement->fetch()) {
                                            echo ' <tr>
                                                <td>'.$organigramme['nom'].'</td>
                                                <td>'.$organigramme['date'].'</td>
                                                <th class ="action text-center">
                                                    <a href="view_organigramme.php?id=' . $organigramme['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                                    <a href="delete_organigramme.php?id=' . $organigramme['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                                    </th>
                                                    </tr>';
                                                };
                                                // <a href="update_document.php?id=' . $organigramme['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
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
                                <a href="insert_membre_ape.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
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
                                        $statement = $db->query('SELECT membres_ape.id, membres_ape.nom, membres_ape.prenom, membres_ape.fonction, membres_ape.image               
                                                                FROM membres_ape
                                                                ');
                                            
                                        //boucle sur toute les lignes de la BDD
                                        while($membre_ape = $statement->fetch()) {
                                            echo ' <tr>
                                                <td>'.$membre_ape['nom'].'</td>
                                                <td>'.$membre_ape['prenom'].'</td>
                                                <td>'.$membre_ape['fonction'].'</td>
                                                <th class ="action text-center">
                                                    <a href="view_membre_ape.php?id=' . $membre_ape['id'] . ' " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                                    <a href="delete_membre_ape.php?id=' . $membre_ape['id'] . '" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                                    </th>
                                                    </tr>';
                                                };
                                                // <a href="update_membre_ape.php?id=' . $membre_ape['id'] . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                        Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
        <?php
            } else  { 
        ?>
            <div id="login-body" class='connexion'>
                <h1 class='text-dark'>S'identifier</h1>

                <?php if(isset($_GET['error'])) {

                    if(isset($_GET['message'])) {
                        echo'<div class="alert error">'.htmlspecialchars($_GET['message']).'</div>';
                    }

                } ?>
                 
                <form method="post" action="connect.php">
                    <input type="email" name="email" placeholder="Votre adresse email" required />
                    <input type="password" name="password" placeholder="Mot de passe" required />
                    <button id="btn-registre" type="submit">S'identifier</button>
                </form>
        

                <p class="grey">Première visite ? <a href="register.php">Inscrivez-vous</a>.</p>
        <?php 
            } 
        ?>
    </section>

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