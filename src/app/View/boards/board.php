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
  <!-- Get data from a topic and display it -->

  <!-- temporary, show arrows and wrench fonts  -->
  <!-- Font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <?php
    /* Loop on topics of the board to display them */
  ?>
  <?php require '../app/View/includes/header.php'; ?>
    <section class="">
      <h3><a href="../app/index.php?page=category&id=<?= $board['id'] ?>"><?= $board['name'] ?></a></h3>
      <i><?= $board['description'] ?></i>
      <br>
      <a href="../public/index.php?page=newtopic&boardid=<?= $board['id'] ?>"><button>Create topic</button></a>
      <?php foreach ($topics as $topic): ?>
        <article>
          <a href="../app/index.php?page=topic&id=<?= $topic['id'] ?>"><?= $topic['title'] ?> by <?= $topic['author'] ?> [<?= $topic['creation_date'] ?>]</a>
        </article>
      <?php endforeach; ?>
    </section>
  <?php require '../app/View/includes/footer.php'; ?>  
</body>
</html>
