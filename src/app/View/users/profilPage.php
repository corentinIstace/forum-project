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
  <header>
    
    <!-- Background image -->
    <div class="mask gradient-custom">
        <div class="d-flex justify-content-center align-items-center h-100">
        <h1 class="text-white mb-0">The ring's Forum</h1>
      </div>
    </div>
    <!-- Background image -->

  </header>
  <main>
    <body>
        <header>
            <h1>Welcome <?= $_SESSION['user_nickname'] ?></h1>
            <img src="" alt="img avatar">
        </header>
        <nav>
            <ul>
                <li><a href="../app/index.php?page=home">Home</a></li>
                <li><a href="#name_change">Nickname's change</a> </li>
                <li><a href="#password_change">Password's change</a> </li>
                <li><a href="#avatar_change">Avatar's change</a> </li>
                <li><a href="#activities">Activities</a></li>
                <form method="POST" action="../app/index.php?page=profile">
                    <input type="submit" name="logout" value="Logout">
                </form>
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
            <form method="post" action="../app/index.php?page=profile" class="form">
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
            <form method="post" action="../app/index.php?page=profile" class="form">
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
        </section>
        
        <section id="activities">
        <h2>Your Activities:</h2>
        
        </section>
        </main>
    <footer>
      <section class="white-footer">
        <!-- Grid container -->
        <div class="container p-4">
          <!-- Section: Social media -->
          <section class="mb-4">
            <!-- Twitter -->
            <a class="btn btn-outline-light btn-floating border rounded-circle m-1 " href="#!" role="button"><i class="fab fa-twitter"></i></a>
            <!-- Apple -->
            <a class="btn btn-outline-light btn-floating border rounded-circle m-1" href="#!" role="button"><i class="fab fa-apple"></i></a>
            <!-- Facebook -->
            <a class="btn btn-outline-light btn-floating border rounded-circle m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
            <!-- Code Pen -->
            <a class="btn btn-outline-light btn-floating border rounded-circle m-1" href="#!" role="button"> <i class="fab fa-codepen"></i></a>
            <!-- Google -->
            <a class="btn btn-outline-light btn-floating border rounded-circle m-1" href="#!" role="button"><i class="fab fa-google"></i></a>
            <!-- Digg -->
            <a class="btn btn-outline-light btn-floating border rounded-circle m-1" href="#!" role="button"><i class="fab fa-digg"></i></a>
            <!-- Pinterest -->
            <a class="btn btn-outline-light btn-floating border rounded-circle m-1" href="#!" role="button"><i class="fab fa-pinterest"></i></a>
          </section>
      </section>
      <section class="black-footer">
        <i class="fas fa-envelope">Contact us</i>
        <i class="fas fa-shield-alt">The team</i>
        <i class="fas fa-check">Terms</i>
        <i class="fas fa-lock">Privacy</i>
        <i class="fas fa-users">Members</i>
        <i class="fas fa-trash-alt">Delete cookies</i>
        <p>All times are UTC</p>
      </section>
      <section class="powered-by">
        <a href="">Powered by Couch Potatoes</a>
      </section>
    </footer>
    </body>
</html>