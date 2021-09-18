<?php
declare(strict_types=1);

require_once '../app/Model/Board.php';
require_once '../app/Model/Boards.php';

class BoardController
{
  private $errors = array();

  private function addError($value, $message)
  {
    $this->errors[$value] = $message;
  }

  private function getValidateBoard($new)
  {
      // Sanitize
      $id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
      $name = filter_has_var(INPUT_POST, 'name') ? filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING) : null;
      $description = filter_has_var(INPUT_POST, 'description') ? filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING) : null;
      // Validate
      $id = filter_var($id, FILTER_VALIDATE_INT);
      if(!$name) { $this->addError("name", "Invalid"); }
      if(!$new && !$id) { $this->addError("id", "Invalid"); }
      if(count($this->errors) > 0) { return false; }
      // if(!$description) { $this->addError("description", "Invalid"); } // description is optionnal
      return [
        'id' => $id, 
        'name' => $name, 
        'description' => $description
      ];
  }

  private function isValide()
  {
    if(count($this->errors) > 0){
      // Some errors where detected, whe display them and cancel insertion
      // TODO use a error view instead
      echo "<pre>";
      print_r($this->errors);
      echo "</pre>";
      return false;
    }
    return true;
  }

  public function getAllBoards()
  {
    $model = new Boards;
    return $model->getBoards();
  }

  public function getSingleBoard()
  {
    // Validate the asked id then display the category board and its topics
    $id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
      $this->addError("id", "Invalid");
    }
    if (!$this->isValide()) {
      return false;
    }
    $model = new Boards;
    $board = $model->getSingleBoard($id);
    $model = new Topics;
    $topics = $model->getTopics($id);
    require '../app/View/boards/board.php';
  }

  public function listBoards()
  {
    // Show list of boards or retrieve a clicked board and repath to edit board
    if(!filter_has_var(INPUT_POST, 'id')){
      // Listing of boards
      // Instantiate boards model (db access) and retrieve data
      $model = new Boards;
      $boards = $model->getBoards();
      // Loop converting array elements into board from the class
      foreach($boards as $key => $board){
        $boards[$key] = new Board((int)$board['id'], $board['name'], $board['description']);
      }
      // Load the view
      require '../app/View/boards/listBoards.php';
    }
    else {
      $id = filter_has_var(INPUT_POST, 'id') ? filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) : null;    
      $id = filter_var($id, FILTER_VALIDATE_INT);  
      if($id) {header("Location:index.php?page=editBoard&id=$id");}
      else { /* TODO error find board */}
    }
  }

  public function addBoard()
  {
    // Send the form view then handle form data for insertion of a board
    if(count($_POST) == 0) {
      // Display form
      require '../app/View/boards/newBoard.php';
    }
    else {
      // Retrieve data from the form, proceed validation and insertion
      $board = $this->getValidateBoard(TRUE);
      if($this->isValide()){
        // Nothing wrong, will proceed the insertion then display the list of boards
        $model = new Boards;
        $model->setBoard($board);
        header("Location:index.php?page=categories");
      }
    }
  }

  public function editBoard()
  {
    // If no post incoming data, retrieve board from get id and show prefilled form
    // Else proceed with incoming post data for update
    if(count($_POST) == 0) {
      $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;
      $id = filter_var($id, FILTER_VALIDATE_INT);
      if(!$id) { 
        // TODO display error
        return;
      }
      $model = new Boards;
      $board = $model->getSingleBoard($id);
      // TODO check if text with spaces can be sent with get
      $_GET['name'] = $board["name"];
      $_GET['description'] = $board["description"];
      require '../app/View/boards/newBoard.php';
    }
    else {
      $board = $this->getValidateBoard(FALSE);
      if($this->isValide()){
        // Nothing wrong, will proceed the update then display the list of boards
        $model = new Boards;
        $model->editBoard($board);
        header("Location:index.php?page=categories");
      }
    }
  }

  public function deleteBoard()
  {
    // Check if incoming id is valid 
    // then check if the board exist 
    // then delete it
    if(isset($_GET['id'])){
      $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
      $id = filter_var($id, FILTER_VALIDATE_INT);
      if($id){
        $model = new Boards();
        $board = $model->getSingleBoard($id);
        if($board['id'] == $id) { 
          $model->deleteBoard($id); 
          header("Location:index.php?page=categories");
        }
        else { /* TODO error */}
      }
      else { /* TODO error */}
    }
  }
}