<!-- Get data from a topic and display it -->

<!-- temporary, show arrows and wrench fonts  -->
<!-- Font awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


<section>
  <h1><?= $topic['title'] ?></h1>
  <button>
    <?php if(!$topic['isLock']): ?>
      <a href="../app/index.php?page=replytopic&id=<?= $topic['id'] ?>">Post Reply&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-reply"></i><a>
    <?php else: ?>
       Locked by owner
    <?php endif; ?>
  </button>
  <button><i class="fas fa-wrench"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-caret-down"></i></button>
  <?php foreach ($messages as $message) : /* Loop to display messages */?>
    <section>
        <h3><?= $message->creation_date ?></h3><br>
        <p><?= $message->description ?></p><br>
        <?php if(isset($_SESSION) && $message->author_id == $_SESSION['id']): ?>
          <button type="submit">Edit message</button><br>
        <?php endif; ?>
    </section>
  <?php endforeach; ?>
  <?php if(isset($_SESSION) && $_SESSION['name']): /* If topic displayed while connected, show a form to add a message */?>
    <form class="clearfix" method="post" id="comment_form">
      <h4>Post a comment:</h4>
      <textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
      <button class="btn btn-primary btn-sm pull-right" id="submit_comment">Submit comment</button>
    </form>
  <?php endif; ?>
</section>