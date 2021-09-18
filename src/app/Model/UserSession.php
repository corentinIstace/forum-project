<?php
  require_once "../app/config/config.php";
  require_once "../app/libraries/DatabaseManager.php";
  
  class UserSession extends DatabaseManager{
    
    public function logout(){
      if(isset($_POST['logout'])){
        session_destroy();
        header("Location:../app/index.php?page=home");
      }
    }
}
