<?php 
    require './admin/database.php';
    //connection a la fonction statique (::) de la bdd 
    $db = Database::connect();
?>

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
        <section class="baniere-parents d-flex justify-content-center">
            <h1 class="align-self-center">Parents délégués</h1>
        </section>
        <section class="parents container-fluid d-flex align-items-center justify-content-center mt-5" style="height:100vh">
          <div class="row d-flex justify-content-center align-items-start">
            <?php
              $classTab = ['PS', 'PS / MS', 'MS', 'MS / GS', 'GS', 'GS / CP','CP', 'CP / CE1', 'CE1', 'CE1 / CE2' , 'CE2' , 'CE2 / CM1' ,  'CM1', 'CM1 / CM2' , 'CM2' ];

              foreach ($classTab as $class) {
                  $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues', PDO::FETCH_ASSOC);
                  while($parents = $statement->fetch(PDO::FETCH_ASSOC)){
                  if($parents['classe'] == $class) {
            ?>
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 m-2 ">
                    <div class="row">
                    <h2 class='text-center'><?php echo $parents['classe'] ?></h2>
                      <?php
                          $statement = $db->query('SELECT UPPER(nom) AS nom, prenom, classe, fonction, image FROM parents_delegues ORDER BY fonction DESC', PDO::FETCH_ASSOC);
                          foreach ($statement as $row) : 
                            if($row['classe'] == $class) {
                              ?>
                      
                          <div class="col-6">
                            <div class="row"> 
                              <img class='img-fluid' height="560px" width="420px" src ="./images/<?php echo $row['image'] ?>"/>
                            </div>
                            <div class="row d-flex justify-content-center fw-bolder"> <?php echo $row['fonction'] ?></div>
                            <div class="row d-flex justify-content-center text-center"> <?php echo $row['prenom'] ?> </br> <?php echo $row['nom'] ?></div>
                          </div>
                  <?php
                    } 
                  endforeach;
                  ?>
                  </div>
                </div>
            <?php
                } else {
                    echo '';
                  }
                };
              }
            ?>
          </div>
        </section>
        <section class="contact d-flex justify-content-sm-evenly align-items-center text-white">
            <h3>Contactez nous</h3>
            <a href="mailto:sandrinekencker@hotmail.com" >Contact</a>
        </section>
    </main>
    <?php 
      require_once 'footer.php';
    ?>
