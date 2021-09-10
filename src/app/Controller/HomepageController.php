<?php

declare(strict_types=1);

require_once '../app/Controller/BoardController.php';

class HomepageController
{
  public function index()
  {
    // Get data from Boards, Topics
    $boards = (new BoardController())->getAllBoards();

    require "../app/View/Home.php";
  }
}