<?php
  /* Loop on topics of the board to display them */
?>
<?php require '../app/View/includes/header.php'; ?>
  <section>
    <h3><a href="../app/index.php?page=category&id=<?= $board['id'] ?>"><?= $board['name'] ?></a></h3>
    <i><?= $board['description'] ?></i>
    <?php foreach ($topics as $topic): ?>
      <article>
        <a href="../app/index.php?page=topic&id=<?= $topic['id'] ?>"><?= $topic['title'] ?> by <?= $topic['author_id'] ?> at <?= $topic['creation_date'] ?></a>
      </article>
    <?php endforeach; ?>
  </section>
<?php require '../app/View/includes/footer.php'; ?>  