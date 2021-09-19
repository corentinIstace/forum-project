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
</body>
</html>