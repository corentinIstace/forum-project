<?php
class DatabaseManager{
  // Get values from config file
  private $dbHost = DB_Host;
  private $dbUser = DB_User;
  private $dbPass = DB_Pass;
  private $dbName = DB_Name;

  protected function connectDb()
  {
    try{
      // Instantiate access to the database and return the access object
      $db = new PDO('mysql:host=' . $this->dbHost .';dbname='. $this->dbName .';',$this->dbUser,$this->dbPass);
      // Throw exceptions when SQL errors are caused
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
    } catch(Exception $e){
      // The connection failed, return the faillure message
      die('Error : '.$e->getMessage());
    }
  }
}