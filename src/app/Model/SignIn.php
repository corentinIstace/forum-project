<?php
  require_once "../app/config/config.php";
  require_once "../app/libraries/DatabaseManager.php";

  class SignIn extends DatabaseManager{

    public function connexion(){

      if(isset($_POST['submit'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        if($email != "" && $password != "") {
          try {
            $db = $this->connectDb();
            $query = "select * from `users` where `email`=:email and `password`=:password";
            $stmt = $db->prepare($query);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);

            if($count == 1 && !empty($row)) {
              /******************** Your code ***********************/
              $_SESSION['user_id']   = $row['id'];
              $_SESSION['user_nickname'] = $row['nickname'];
              $_SESSION['user_email'] = $row['email'];
              $_SESSION['user_password'] = $row['password'];
              $_SESSION['user_signature'] = $row['signature'];

              header("Location:../public/index.php?page=profile");              
            } else {
              echo "Invalid username or password or creating acount";
            }
          } catch (PDOException $e) {
            echo "Error : ".$e->getMessage();
          }
        } else {
          echo "Both fields are required!";
        }
      }
    }
  }