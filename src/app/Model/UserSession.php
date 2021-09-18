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
    
    public function changeNickname(){
          if(isset($_POST['changeName'])){
              // connect to the bookdb database
              $db = $this->connectDb();
              $data = [
                  'id' => $_SESSION['user_id'],
                  'nickname' => $_POST['new_nickname']
              ];
              $sql = 'UPDATE users SET nickname = :nickname WHERE id = :id'; 
              // prepare statement
              $statement = $db->prepare($sql);
              // execute the UPDATE statment
              if ($statement->execute($data)) {
                  $sql = 'SELECT nickname FROM users WHERE id = :id'; 
                  $statement = $db->prepare($sql);
                  $statement->execute($data);
                  $_SESSION['user_nickname'] = $_POST['new_nickname'];
                  header("Location:../app/index.php?page=profile");
              }   
          }
      }
      public function changePassword(){
          if(isset($_POST['changePassword'])){
              // connect to the bookdb database
              $db = $this->connectDb();
              $data = [
                  'id' => $_SESSION['user_id'],
                  'password' => $_POST['new_password']
              ];
              $sql = 'UPDATE users SET password = :password WHERE id = :id'; 
              // prepare statement
              $statement = $db->prepare($sql);
              // execute the UPDATE statment
              if ($statement->execute($data)) {
                  $sql = 'SELECT password FROM users WHERE id = :id'; 
                  $statement = $db->prepare($sql);
                  $statement->execute($data);
                  $_SESSION['user_password'] = $_POST['new_password'];
                  header("Location:../app/index.php?page=profile");
              }   
          }
      }
}
