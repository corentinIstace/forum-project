<?php

try {
  $db = new PDO('mysql:host=mysql;dbname=forum-project;', 'root', 'root');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  
} catch (PDOException $e) {
  echo "Connection failed : ". $e->getMessage();
}

if(isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  if($email != "" && $password != "") {
    try {
      $query = "select nickname from `users` where `email`=:email and `password`=:password";
      $stmt = $db->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
        
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