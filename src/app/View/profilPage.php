
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil Page</title>
</head>
<body>




<?php
    session_start();
    if(isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id'] != "") {
      echo '<h1>Welcome '.$_SESSION['sess_name'].'</h1>';
      echo '<h4><a href="logout.php">Logout</a></h4>';
    } else { 
      header('location:index.php');
    }
?>
</body>
</html>