<section>
  <?= !isset($_GET['name']) ? "<h3>Create a new category of topics</h3>" : "<h3>Edit category of topics</h3>" ?>
  <?php 
    $name = isset($_GET['name']) ? $_GET['name'] : "";
    $desc = isset($_GET['description']) ? $_GET['description'] : "";
  ?>
  <form action="" method="post">
    <label for="name">Name</label><br>
    <input type="text" name="name" placeholder="Name of category" value="<?= $name ?>"><br>
    <label for="description">Description</label><br>
    <input type="text" name="description" placeholder="Description" value="<?= $desc ?>"><br>
    <button type="submit">Send</button>
  </form>
</section>