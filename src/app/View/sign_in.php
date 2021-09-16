<?php
  require_once "../app/Model/SignIn.php";

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