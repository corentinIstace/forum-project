<!doctype html>
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
<header>



  <!-- Background image -->
  <div class="mask gradient-custom">
    <section class="connexions-buttons">
      <div class="register-button-div">
        <svg class="register-logo" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
          <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
          <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
        </svg>
        <button class="register-button"><a href="../app/index.php?page=sign_up">Register</a></button>
      </div>
      <div class="log-in-button-div">
        <svg class="log-in-logo" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
          <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
        </svg>
        <button class="log-in-button"><a href="../app/index.php?page=sign_in">Log in</a> </button>
      </div>

    </section>
    <div class="d-flex justify-content-center align-items-center h-100">
      <h1 class="text-white mb-0">The ring's Forum</h1>
    </div>
  </div>
  </div>
  <!-- Background image -->

</header>

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
  <div class="section_footer">
    <div class="main-sidebar">
      <section class="main-part-forum">
        <div class="row">


          <?php
          /* Loop on boards and topics to display them */

          foreach ($boards as $board) : ?>

            <div class="board-container">

              <h3><a href="../app/index.php?page=category&id=<?= $board['id'] ?>"><?= $board['name'] ?></a></h3>
              <i class="testDescription"><?= $board['description'] ?></i>
              <hr class="board-hr">
              <div class="bottom-boards align-self-sm-end">
                <div class="topics">
                  <strong>
                    <p class="board-stats-topic">459</p>
                  </strong>
                  <p class="board-name-stats-topics">Topics</p>
                </div>
                <div class="posts">
                  <strong>
                    <p class="board-stats-posts">908</p>
                  </strong>
                  <p class="board-name-stats-posts">Posts</p>
                </div>
                <div class="last-post">
                  <strong>
                    <p class="board-stats-lastPost">Sun Feb 03</p>
                  </strong>
                  <p class="board-name-stats-lastPost">Last Post</p>
                </div>
              </div>




              <?php foreach ($topics as $topic) :
                if ($topic['board_id'] == $board['id']) :
              ?>
                  <div class="article-dn">
                    <a href="../app/index.php?page=topic&id=<?= $topic['id'] ?>"><?= $topic['title'] ?> by <?= $topic['author_id'] ?> at <?= $topic['creation_date'] ?></a>
                  </div>

              <?php
                endif;
              endforeach; ?>
            </div>
          <?php
          endforeach;
          ?>
        </div>

      </section>
      <section class="sidebar">
        <div class="input-group">
          <div class="form-outline">
            <input type="search" id="form1" class="form-control" placeholder="Search..." />
          </div>
          <div class="search-button"> <button type="button" class="btn btn-primary">
              <i class="fas fa-search"></i>
            </button></div>

        </div>
        <hr />
        <form>
          <div class="mb-3">
            <div class="form-label-username">
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="mb-3">
            <div class="form-label-password">
              <label for="exampleInputPassword1" class="form-label"> Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
          </div>
          <div class="button-login">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </section>
    </div>
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
  </div>
</body>

</html>