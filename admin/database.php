<?php 
      
//connexion à la bdd
class Database  {

  private static $dbHost = 'localhost';
  private static $dbName = 'ape';
  private static $dbUser = 'root';
  private static $dbUserPassword = '';

  private static $connection = null;

  // FONCTION POUR SE CONNEXION A LA BDD
  public static function connect() {
  try{
    self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbUserPassword);
  } catch(Exception $e) {
    die('erreur : '. $e->getMessage());
  }
  return self::$connection;
  }

  // FONCTION DE DECONNECTION
  public static function disconnect() {
    self::$connection = null;
  }
}

Database::connect();

$db = Database::connect();


// fonction de Selection de donnee dans la BDD
function selectdata ($table,$id,$db) {
  $data = $db->prepare("SELECT * FROM $table where id = :id");
  $data->bindParam(':id', $id);  
  $data->execute();
  return $data->fetch(PDO::FETCH_ASSOC);
}

// fonction de suppression de donne de la BDD

function deletdata ($table,$id,$db) {
  $data = $db->prepare("DELETE FROM $table where id = :id");
  $data->bindParam(':id', $id);  
  $data->execute();
  return $data->fetch(PDO::FETCH_ASSOC);
}


// fonction insertion image accueil

function insertImage ($table, $db, $paramTable, $value) {
  global $name;
  global $shaFileExtImage;
  $paramTable = ['nom', 'image'];
  $value = [':nom', ':image'];
  $table = 'image_accueil';
  $statement = $db->prepare("INSERT INTO $table ($paramTable[0], $paramTable[1]) values($value[0], $value[1])");
  $statement->execute(array($paramTable[0]=>$name, $paramTable[1]=>$shaFileExtImage));
  header("Location: connect.php");
}
// fonction insertion lien utile

function insertLien ($table, $db, $paramTable, $value) {
  global $name;
  global $href;
  $paramTable = ['nom', 'href'];
  $value = [':nom', ':href'];
  $table = 'lienUtile';
  $statement = $db->prepare("INSERT INTO $table ($paramTable[0], $paramTable[1]) values($value[0], $value[1])");
  $statement->execute(array($paramTable[0]=>$name, $paramTable[1]=>$href));
  header("Location: connect.php");
}


//fonction insertion conseil d'écoles

function insertConseil ($table, $db, $paramTable, $value) {
  global $name;
  global $date;
  global $shaFileExtFichier;
  $paramTable = ['nom', 'date', 'fichier'];
  $value = [':nom', ':date', ':fichier'];
  $table = 'conseils_ecole';
  $statement = $db->prepare("INSERT INTO $table ($paramTable[0], $paramTable[1], $paramTable[2]) values($value[0], $value[1], $value[2])");
  $statement->execute(array($paramTable[0]=>$name, $paramTable[1]=>$date, $paramTable[2]=>$shaFileExtFichier));
  header("Location: connect.php");
}

//fonction insertion conseil d'écoles

function insertOrganigramme ($table, $db, $paramTable, $value) {
  global $name;
  global $date;
  global $shaFileExtFichier;
  $paramTable = ['nom', 'date', 'fichier'];
  $value = [':nom', ':date', ':fichier'];
  $table = 'organigramme';
  $statement = $db->prepare("INSERT INTO $table ($paramTable[0], $paramTable[1], $paramTable[2]) values($value[0], $value[1], $value[2])");
  $statement->execute(array($paramTable[0]=>$name, $paramTable[1]=>$date, $paramTable[2]=>$shaFileExtFichier));
  header("Location: connect.php");
}

// fonction insertion evenement

function insertEvent ($table, $db, $paramTable, $value) {
  global $name;
  global $date;
  global $shaFileExtFichier;
  global $shaFileExtImage;
  global $description;
  $paramTable = ['nom', 'date', 'description', 'image','fichier'];
  $value = [':nom', ':date', ':description', ':image', ':fichier'];
  $table = 'evenement';
  $statement = $db->prepare("INSERT INTO $table ($paramTable[0], $paramTable[1], $paramTable[2], $paramTable[3], $paramTable[4]) values($value[0], $value[1], $value[2], $value[3], $value[4])");
  $statement->execute(array($paramTable[0]=>$name, $paramTable[1]=>$date, $paramTable[2]=>$description, $paramTable[3]=>$shaFileExtImage, $paramTable[4]=>$shaFileExtFichier));
  header("Location: connect.php");
}
// fonction insertion parents eleves

function insertParents ($table, $db, $paramTable, $value) {
  global $name;
  global $prenom;
  global $fonction;
  global $shaFileExtImage;
  global $classe;
  $paramTable = ['nom', 'prenom', 'fonction', 'image','classe'];
  $value = [':nom', ':prenom', ':fonction', ':image', ':classe'];
  $table = 'parents_delegues';
  $statement = $db->prepare("INSERT INTO $table ($paramTable[0], $paramTable[1], $paramTable[2], $paramTable[3], $paramTable[4]) values($value[0], $value[1], $value[2], $value[3], $value[4])");
  $statement->execute(array($paramTable[0]=>$name, $paramTable[1]=>$prenom, $paramTable[2]=>$fonction, $paramTable[3]=>$shaFileExtImage, $paramTable[4]=>$classe));
  header("Location: connect.php");
}


?>