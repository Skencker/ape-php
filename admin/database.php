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



?>