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
        <section class="baniere-doc d-flex justify-content-center">
            <h1 class="align-self-center">Liens Utiles</h1>
        </section>
        <section class="lienUtile d-flex flex-column align-items-center mt-5" style="height: 900px" >
            <div class="p-2">
            <?php
                $statement = $db->query('SELECT * FROM lienUtile', PDO::FETCH_ASSOC);                  
                foreach ($statement as $row):  ?>              
                    <a href="<?php echo $row['href']?>"> <?php echo $row['nom'] ?> </a> </br> </br>
                    <?php
                endforeach;
                ?>
      
        </section>
       
        <section class="contact d-flex justify-content-sm-evenly align-items-center text-white">
                
            <h3>Contactez nous</h3>
            <a href="mailto:sandrinekencker@hotmail.com" >Contact</a>
        </section>
    </main>
    <?php 
      require_once 'footer.php';
    ?>

