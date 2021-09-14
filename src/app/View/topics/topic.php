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
  <?php foreach ($messages as $message) : ?>
    <section>
        <h3><?= $board->name ?></h3><br>
        <em><?= $board->description ?></em><br>
        <button type="submit">Edit category</button><br>
    </section>
  <?php endforeach; ?>
</section>