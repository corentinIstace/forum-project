<?php

declare(strict_types=1);

require_once '../app/Controller/BoardController.php';
require_once '../app/Controller/TopicController.php';

class HomepageController
{
  public function index()
  {
    // Get data from Boards, Topics
    $boards = (new BoardController())->getAllBoards();
    $topics = (new TopicController())->getHomeTopics();
    require "../app/View/Home.php";
  }
}