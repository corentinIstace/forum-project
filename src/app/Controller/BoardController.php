<?php
declare(strict_types=1);

require_once '../app/Model/Board.php';
require_once '../app/Model/Boards.php';

class BoardController
{
  public function listBoards()
  {
    // Instantiate boards model (db access) and retrieve data
    $model = new Boards;
    $boards = $model->getBoards();
    // Loop converting array elements into board from the class
    foreach($boards as $key => $board){
      $boards[$key] = new Board($board['name'], $board['description']);
    }
    // Load the view
    require '../app/View/listBoards.php';
  }
}