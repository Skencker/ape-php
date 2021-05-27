<?php 

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