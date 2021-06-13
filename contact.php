<!DOCTYPE html>
<html lang="fr">
<?php 
          require_once 'head.php';
        ?>
  <body>
  <?php 
          require_once 'header.php';
        ?>
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
    <?php 
        require_once 'footer.php';
    ?>

