<?php
declare(strict_types=1);

require_once '../app/Model/Board.php';
require_once '../app/Model/Boards.php';

class BoardController
{
  private $errors = array();

  private function addError($value, $message){
    $this->errors[$value] = $message;
  }

  public function listBoards()
  {
    // Listing of boards
    // Instantiate boards model (db access) and retrieve data
    $model = new Boards;
    $boards = $model->getBoards();
    // Loop converting array elements into board from the class
    foreach($boards as $key => $board){
      $boards[$key] = new Board($board['name'], $board['description']);
    }
    // Load the view
    require '../app/View/boards/listBoards.php';
  }

  public function addBoard()
  {
    // Send the form view then handle form data for insertion of a board

    if(count($_POST) == 0) {
      // Display form
      require '../app/View/boards/addBoard.php';
    }
    else {
      // Retrieve data from the form, proceed validation and insertion
      // Sanitize
      $name = filter_has_var(INPUT_POST, 'name') ? filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING) : null;
      $description = filter_has_var(INPUT_POST, 'description') ? filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING) : null;
      // Validate
      if(!$name) { $this->addError("name", "Invalid"); }
      // if(!$description) { $this->addError("description", "Invalid"); } // description is optionnal

      if(count($this->errors) > 0){
        // Some errors where detected, whe display them and cancel insertion
        // TODO use a error view instead
        echo "<pre>";
        print_r($this->errors);
        echo "</pre>";
      }
      else {
        // Nothing wrong, will proceed the insertion then display the list of boards
        $board = new Board($name, $description);
        $model = new Boards;
        $model->setBoard($board);
        header("Location:index.php?page=categories");
      }
    }
  }
}