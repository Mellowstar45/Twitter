<?php
class MyDatabase
{
  public $Db;
  public function __construct()
  {
    $this->Db = $this->connectDb();
  }

  protected function connectDb()
  {
    $host = "localhost";
    $database = "twitter_aca";
    $user = "Mellowstar";
    $pass = 'grumpycat';
    try {
      $connexion = "mysql:host=$host;dbname=$database;charset=utf8";
      $Db = new PDO($connexion, $user, $pass);
    } catch (Exception $e) {
      die('<h1>Erreur : ' . $e->getMessage() . "</h1>");
    }
    return $Db;
  }

  public function __destruct()
  {
    unset($this->Db);
  }
}
