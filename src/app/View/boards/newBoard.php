<?php require '../app/View/includes/header.php'; ?>
<section>
  <?php $new = !isset($_GET['name']) ? TRUE : FALSE ?>
  <?= $new ? "<h3>Create a new category of topics</h3>" : "<h3>Edit category of topics</h3>" ?>
  <?php
  $id = isset($_GET['id']) ? $_GET['id'] : "";
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

  <?php if (!$new) { ?>
    <button type="text">
      <a href="../app/index.php?page=deleteboard&id=<?= $id ?>" onclick="return confirm('Are your sure to delete <?= $name ?>')">
        Delete this category
      </a>
    </button>
  <?php } ?>

</section>
<?php require '../app/View/includes/footer.php'; ?>  