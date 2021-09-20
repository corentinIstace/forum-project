<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../public/css/screen.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/9b934638d1.js" crossorigin="anonymous"></script>

  <title>Seigneur Des Anneaux</title>
</head>

<body>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  <main>
        <?php require '../app/View/includes/header.php'; ?>
        <header>
          <h1 id="titre">Welcome <?= $_SESSION['user_nickname'] ?></h1>
        </header>
        <nav>
            <ul>
                <li><a href="../public/index.php?page=home">Home</a></li>
                <li><a href="#name_change">Nickname's change</a> </li>
                <li><a href="#password_change">Password's change</a> </li>
                <li><a href="#avatar_change">Avatar's change</a> </li>
                <li><a href="#activities">Activities</a></li>
            </ul>
        </nav>
        <section id="data">
            <h5>Your ID number is : <?= $_SESSION['user_id'] ?></h5>
            <h5>Your nickname is : <?= $_SESSION['user_nickname'] ?></h5>
            <h5>Your e-mail address is : <?= $_SESSION['user_email'] ?></h5>
            <h5>Your password is : <?= $_SESSION['user_password'] ?></h5>
            <h5>Your signature is : <?= $_SESSION['user_signature'] ?></h5>
        </section>
        <section id="name_change">
            <h2>Change your Nickname:</h2>
            <section id="containeur_form">
            <form method="post" action="../public/index.php?page=profile" class="form">
                <label for="id">ID</label>
                <input type='number' name='id'><br><br>
                <label for="nickname">Current nickname</label>
                <input type='text' name='nickname'><br><br>
                <label for="new_nickname">New nickname</label>
                <input type='text' name='new_nickname'><br><br>
                <input type='submit' name='changeName' value='Change Nickname'>
            </form> 
            </section>
        </section>
        
        <section id="password_change">
        <h2>Change your password:</h2>
        <section id="containeur_form">
            <form method="post" action="../public/index.php?page=profile" class="form">
                <label for="password">Current password</label>
                    <input type='text' name='password'><br><br>
                <label for="new_password">New password</label>
                    <input type='text' name='new_password'><br><br>
                 <input type='submit' name='changePassword' value='Change password'>
            </form> 
        </section>
        </section>
        <section id="avatar_change">
          <h2>Change your avatar:</h2>
          <section id="containeur_form">
            <section form="form" class="form">
              <div id="uploadImage">
                <div id="preview">
                  <img id="previewDisplay" src="<?= $avatar ?? '' ?>" >
                </div>
              </div>
              <form id="imageInput">
                <input id="imageFile" type="file" onchange="previewFile()" accept="image/*" /><br />
              </form>
              <form action="../public/index.php?page=profile" method="post" id="uploaderForm">
                <input type="text" name="avatar" id="avatar" hidden="true" />
                <button type="button" onclick="sendForm()" >Send new avatar</button>
              </form>
              <script src="../public/js/avatarHandler.js"></script>
            </section>
          </section>
          </section>
        
        <section id="activities">
          <h2>Your Activities:</h2>
        
        </section>
  </main>
      <?php require '../app/View/includes/footer.php'; ?>  
    </body>
</html>