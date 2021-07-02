<?php
	
	session_start();

	if(isset($_SESSION['connect'])){
		header('location: connect.php');
		exit();
	}

	if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_two'])){

		require('database.php');

		// VARIABLES
		$email 				= htmlspecialchars($_POST['email']);
		$password 			= htmlspecialchars($_POST['password']);
		$password_two		= htmlspecialchars($_POST['password_two']);

		// PASSWORD = PASSWORD TWO
		if($password != $password_two){

			header('location: register.php?error=1&message=Vos mots de passe ne sont pas identiques.');
			exit();

		}

		// ADRESSE EMAIL VALIDE
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

			header('location: register.php?error=1&message=Votre adresse email est invalide.');
			exit();

		}

		// EMAIL DEJA UTILISEE
		$req = $db->prepare("SELECT email FROM user WHERE email = :email");
		// $req = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = :email");
        $req->bindValue(':email', $email, PDO :: PARAM_STR);  
        $req->execute();

		while($email_verification = $req->fetch(PDO::FETCH_ASSOC)){

			if($email_verification['numberEmail'] != 0){

				header('location: register.php?error=1&message=Votre adresse email est déjà utilisée par un autre utilisateur.');
				exit();

			}

		}

		// CHIFFRAGE DU MOT DE PASSE
		$password = password_hash($password, PASSWORD_DEFAULT);

		// ENVOI
		$req = $db->prepare("INSERT INTO user(email, password, secret) VALUES(:email,:password,:secret)");
		$req->execute(array('email'=>$email, 'password'=>$password, 'secret'=>$secret));

		header('location: connect.php?success=1');
		exit();

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
	<section>
		<div id="login-body">
			<h1 class="text-dark">S'inscrire</h1>
			<?php if(isset($_GET['error'])){
				if(isset($_GET['message'])) {
					echo'<div class="alert error">'.htmlspecialchars($_GET['message']).'</div>';
				}
			} else if(isset($_GET['success'])) {
				echo'<div class="alert success">Vous êtes désormais inscrit. <a href="connect.php">Connectez-vous</a>.</div>';
			} 
            ?>
			<form method="post" action="register.php">
				<input type="email" name="email" placeholder="Votre adresse email" required />
				<input type="password" name="password" placeholder="Mot de passe" required />
				<input type="password" name="password_two" placeholder="Retapez votre mot de passe" required />
				<button type="submit">S'inscrire</button>
			</form>

			<p class="grey">Déjà inscrit ? <a href="connect.php">Connectez-vous</a>.</p>
		</div>
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