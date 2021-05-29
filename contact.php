<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font google-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Caveat&display=swap"
      rel="stylesheet"
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

    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="style.css" />
    <title>APE SPDL</title>
  </head>
  <body>
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a href="#"> 
                  <img class="img img-fluid w-75 ps-3" src="./images/logo.png" alt="logo">
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
                              <a class="nav-link " aria-current="page" href="index.php"> Accueil</a>
                            </li>
                            <li class="nav-item me-5">
                              <a class="nav-link" href="actualites.html">Actualités</a>
                            </li>
                            <li class="nav-item me-5">
                              <a class="nav-link " href="parents.php">Parents Délégués</a>
                            </li>
                            <li class="nav-item me-5">
                            <a class="nav-link" href="doc.php">Documents</a>
                            </li>
                        
                            <li class="nav-item me-5">
                              <a class="nav-link active" href="contact.php">Contact</a>
                            </li>
                         
                        </ul>
                      </div>
                </div>
            </div>
          </nav>
    </header>
    <main>
        <section class="baniere-contact d-flex justify-content-center">
            <h1 class="align-self-center">Contact</h1>
        </section>
        <section class="content container">
            <div class="row ">
              <div class="col-lg-7 d-flex flex-column justify-content-center align-items-center text-contact">
                <p class="w-75">
                  N’hésitez pas à nous contacter par mail pour toutes questions ou informations complémentaires. <br>
                  Afin de répondre au plus vite à votre demande merci d’indiquer : le nom / prénom de votre enfant ainsi que sa classe. <br> Merci
                </p>
                <a href="mailto:sandrinekencker@hotmail.com" class="text-white p-2" >Contact</a>
              </div>
              <div class="col-lg-5 d-flex justify-content-center align-items-center img-contact">
                <img class="img img-fluid  m-5 " src="./images/contact.jpg" alt="">
              </div>
            </div>
        </section>
        <section class="maps container">
          <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center p-5">
              <!-- plan -->
              <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
                    var setting = {"height":531,"width":803,"zoom":13,"queryString":"Saint-Pierre-de-Lages, France","place_id":"ChIJKxqDg22RrhIR4BJBL5z2BgQ","satellite":false,"centerCoord":[43.56570565680264,1.6269875470742168],"cid":"0x406f69c2f4112e0","lang":"fr","cityUrl":"/france/toulouse","cityAnchorText":"Carte de Toulouse, Sud de la France, France","id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3","embed_id":"510435"};
                    var d = document;
                    var s = d.createElement('script');
                    s.src = 'https://1map.com/js/script-for-user.js?embed_id=510435';
                    s.async = true;
                    s.onload = function (e) {
                      window.OneMap.initMap(setting)
                    };
                    var to = d.getElementsByTagName('script')[0];
                    to.parentNode.insertBefore(s, to);
                  })();</script><a href="https://1map.com/fr/map-embed">1 Map</a></div>
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-5">
                <h2>PLAN</h2>
                <hr>
                <h3>Ecole de Saint Pierre de Lages</h3>
                <p>
                  Avenue Vallesville <br>
                  31570 Saint-Pierre-de-Lages <br> <br>

                  E-mail : ape@stpierredelages.fr <br> <br>

                  Téléphone : 05 61 00 00 00 <br>
                </p>
                <h3>Mairie de Saint Pierre de Lages</h3>
                <p>
                  Avenue de Toulouse <br>
                  31570 Saint-Pierre-de-Lages <br> <br>

                  Téléphone : 05 61 83 73 97 <br> <br>
                  E-mail : mairie@stpierredelages.fr <br> <br>
                  Site Web : http://www.stpierredelages.fr/SITE/ <br> <br>
                </p>
            </div>
          </div>

        </section>
        
  
    </main>
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
