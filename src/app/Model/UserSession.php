<?php
  require_once "../app/config/config.php";
  require_once "../app/libraries/DatabaseManager.php";
  
  class UserSession extends DatabaseManager{
    
    public function logout(){
      session_destroy();
      $_SESSION = null;
      header("Location:../public/index.php");      
    }
}