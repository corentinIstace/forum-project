
<section>
  <h1>Category Boards in the forum</h1>
  <?php foreach ($boards as $board) : ?>
    <section>
      <h3><?= $board->name ?></h3> 
      <em><?= $board->description ?></em>
    </section>
  <?php endforeach; ?>
</section>