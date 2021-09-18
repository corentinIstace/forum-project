<section>
  <h1>Category Boards in the forum</h1>
  <?php foreach ($boards as $board) : ?>
    <section>
      <form action="" method="post">
        <input hidden="true" type="number" name="id" value="<?= $board->id ?>">
        <h3><?= $board->name ?></h3><br>
        <em><?= $board->description ?></em><br>
        <button type="submit">Edit category</button><br>
      </form>
    </section>
  <?php endforeach; ?>
</section>