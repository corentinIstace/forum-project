<!-- Get data from a topic and display it -->
<section>
  <h1><?= $topic['title'] ?></h1>
  <?php foreach ($messages as $message) : ?>
    <section>
        <h3><?= $board->name ?></h3><br>
        <em><?= $board->description ?></em><br>
        <button type="submit">Edit category</button><br>
    </section>
  <?php endforeach; ?>
</section>