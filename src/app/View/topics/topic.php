
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
  <?php require '../app/View/includes/header.php'; ?>
  <section>
    <h1><?= $topic['title'] ?></h1>
      <?php if(!$topic['isLock']): ?>
        <a href="#comment_form"><button>Post Reply&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-reply"></i></button><a>
      <?php else: ?>
        <button>Locked by owner</button>
      <?php endif; ?>
    <button><i class="fas fa-wrench"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-caret-down"></i></button>
    <?php foreach ($messages as $message) : /* Loop to display messages */?>
      <section>
          <h3><?= $message['creation_date'] ?></h3><br>
          <p><?= $message['author'] ?></p><br>
          <p><?= $message['content'] ?></p><br>
          <?php if(isset($_SESSION) && $message['author_id'] == $_SESSION['user_id']): ?>
            <button type="submit">Edit message</button><br>
          <?php endif; ?>
      </section>
    <?php endforeach; ?>
    <?php if(isset($_SESSION) && $_SESSION['user_nickname']): /* If topic displayed while connected, show a form to add a message */?>
      <form class="clearfix" action="../public/index.php?page=topic&id=<?= $topic['id'] ?>" method="post" id="comment_form">
        <h4>Post a reply:</h4>
        <?php if(!$topic['isLock']): ?>
          <textarea name="message" id="message" class="form-control" cols="30" rows="3"></textarea>
          <button class="btn btn-primary btn-sm pull-right" id="submit_comment">Post Reply</button>
        <?php else: ?>
          <p>Locked by owner</p>
        <?php endif; ?>
      </form>
    <?php endif; ?>
  </section>
  <?php require '../app/View/includes/footer.php'; ?>  
</body>
</html>

