<?php
  session_start();
  $_SESSION['user_session'] = $userSession;

  require_once "../config/config.php";
  require_once "../libraries/DatabaseManager.php";

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
              $_SESSION['sess_user_id']   = $row['id'];
              $_SESSION['sess_user_nickname'] = $row['nickname'];
              $_SESSION['sess_user_email'] = $row['email'];
              $_SESSION['sess_user_password'] = $row['password'];
              $_SESSION['sess_user_signature'] = $row['signature'];

              header("Location:../View/profilPage.php");
              // echo "Bonjour à vous ";
              // print_r($row['nickname']);
              //  require_once "../View/profilPage.php";
              
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

  $signIn = new SignIn();
  $signIn -> connexion();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign_in</title>
</head>
<body>
    <h1>Connexion:</h1>

    <form action="" method="POST">
            <input type="file" name="avatar" accept="image/png, image/jpeg">
    <hr width="25%">
        <label for="email">E-mail</label>
            <input type="email" name="email" value="">
        <label for="password">Password</label>
            <input type="password" name="password" value="">
        <input type="submit" name="submit" value="Connexion.">
    </form>
</body>
</html>