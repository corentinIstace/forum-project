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
<body>
  <?php require '../app/View/includes/header.php'; ?>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  <div class="main-sidebar">
    <section class="main-part-forum">
      <div class="row">
        <?php
        /* Loop on boards and topics to display them */
        foreach ($boards as $board) : ?>
          <div class="board-container">
            <h3><a href="../public/index.php?page=category&id=<?= $board['id'] ?>"><?= $board['name'] ?></a></h3>
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
                <a href="../public/index.php?page=topic&id=<?= $topic['id'] ?>"><?= $topic['title'] ?> by <?= $topic['author_id'] ?> at <?= $topic['creation_date'] ?></a>
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
        <div class="search-button"> 
          <button type="button" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
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
  <?php require '../app/View/includes/footer.php'; ?>  
</body>

</html>