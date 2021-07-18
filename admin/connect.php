
<?php


require_once ('database.php');
require_once 'security.php';
session_start();

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        //ADRESS EMAIL SYNTAXE
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: connect.php?error=1&message=Votre adresse email est invalide');
            exit();
        }
        // CHIFFRAGE DU MOT DE PASSE
        $password = password_verify($password, $hash);
        // EMAIL DEJA UTILISE
        $statement = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = :email");
        $statement->bindParam(':email', $email); 
        $statement->execute();

        while($email_verification = $statement->fetch()){
            if($email_verification['numberEmail'] != 1){
                header('location: connect.php?error=1&message=Impossible de vous authentifier correctement.');
                exit();
            }
        }

        // CONNEXION
        $statement = $db->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindParam(':email', $email); 
        $statement->execute();
        $hash = $user['password'];
        
        while($user = $statement->fetch(PDO::FETCH_ASSOC)){
                if( $password = $user['password']){
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
    <?php
    require_once 'headerAdmin.php';
    ?> 

    <section class='connexion'>
        <?php 

if(Security::verifAccessSession()) {
                
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
                                        while($image = $statement->fetch()) { ?>
                                            <tr>
                                                <td><?php echo $image['nom'] ?></td>
                                                <th class ="action text-center">
                                                    <a href="view_image_accueil.php?id=<?php echo $image['id'] ?> " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>  
                                                    <a href="delete_image_accueil.php?id=<?php echo $image['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                                </th>
                                            </tr>
                                          
                                    <?php };

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
                            
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        // ON RECUPERE LES DONNEES
                                        $statement = $db->query('SELECT * FROM evenement');
                                    
                                        //boucle sur toute les lignes de la BDD
                                        while($evenement = $statement->fetch()) { 
                                            $date = date('d / m / Y', strtotime($evenement['date']));?>
                                            <tr>
                                                <td> <?php echo $evenement['nom']?></td>
                                                <td><?php echo $date?></td>
                                                <th class ="action text-center">
                                                    <a href="view_event.php?id=<?php echo$evenement['id'] ?> " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                                    <a href="update_event.php?id=<?php echo $evenement['id'] ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                                    <a href="delete_event.php?id=<?php echo $evenement['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                                </th>
                                                </tr>

                                                <?php 
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
                        <a href="insert_parent.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
                    </h2>
                    <table class="table table-striped table-hover table-primary">
                        <thead>
                            <tr>
                                <th>Prenom</th>
                                <th>Nom</th>
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
                                while($parents_delegues = $statement->fetch()) { ?>
                                    <tr>
                                        <td><?php echo$parents_delegues['prenom']?></td>
                                        <td><?php echo$parents_delegues['nom']?></td>
                                        <td><?php echo$parents_delegues['fonction']?></td>
                                        <td><?php echo$parents_delegues['classe']?></td>
                                        <th class ="action text-center">
                                            <a href="view_parent.php?id=<?php echo $parents_delegues['id'] ?> " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                            <a href="update_parent.php?id=<?php echo $parents_delegues['id']?> " class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a> 
                                            <a href="delete_parent.php?id=<?php echo $parents_delegues['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                            </th>
                                            </tr>
                                        <?php };
                            
                            
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
                                while($organigramme = $statement->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $organigramme['nom']?></td>
                                        <td><?php echo $organigramme['date'] ?></td>
                                        <th class ="action text-center">
                                            <a href="view_organigramme.php?id=<?php echo  $organigramme['id'] ?> " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                            <a href="delete_organigramme.php?id=<?php echo  $organigramme['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                            </th>
                                            </tr>
                                            <?php  };
                                Database::disconnect();
                            ?>
                                            <!-- <a href="update_document.php?id=<?php echo  $organigramme['id'] ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a> -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container bg-light p-5 mt-5 ">
                <h1 class='text-center'>Gestion des conseils d'école</h1>
                <div class="row">
                    <h2 class="bold">
                        <a href="insert_conseils_ecole.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
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
                                $statement = $db->query('SELECT id, nom, date, fichier            
                                                        FROM conseils_ecole
                                                        ');
                                    
                                //boucle sur toute les lignes de la BDD
                                while($document = $statement->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $document['nom']?></td>
                                        <td><?php echo $document['date']?></td>
                                        <th class ="action text-center">
                                            <a href="view_conseils_ecole.php?id=<?php echo  $document['id'] ?> " class="btn btn-default btn-sm"><i class="bi bi-eye"></i> Voir</a>
                                            <a href="delete_conseils_ecole.php?id=<?php echo  $document['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                            </th>
                                            </tr>
                                            <?php   };
                                Database::disconnect();
                            ?>
                                        <!-- <a href="update_membre_ape.php?id=<?php echo  $document['id'] ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a> -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container bg-light p-5 mt-5 ">
                <h1 class='text-center'>Gestion des liens utiles</h1>
                <div class="row">
                    <h2 class="bold">
                        <a href="insert_lienUtile.php" class="btn btn-success btn-lg m-2"><i class="bi bi-plus-circle p-2"></i>Ajouter</a>
                    </h2>
                    <table class="table table-striped table-hover table-primary">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Lien</th>
                    
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // ON RECUPERE LES DONNEES
                                $statement = $db->query('SELECT * FROM lienUtile');
                                    
                                //boucle sur toute les lignes de la BDD
                                while($document = $statement->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $document['nom']?></td>
                                        <td><?php echo $document['href']?></td>
                                        <th class ="action text-center">
                                            <a href="delete_lienUtile.php?id=<?php echo  $document['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-file-x"></i> Supprimer</a>      
                                        </th>
                                    </tr>
                                <?php   };
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
                <p class="grey">Première visite ? <a href="register.php">Inscrivez-vous</a>.</p>
                </form>
        

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

</html>