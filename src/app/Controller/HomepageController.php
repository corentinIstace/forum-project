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
    $topics = array();
    foreach($boards as $board){
      $topics = array_merge($topics,(new TopicController())->getHomeTopics($board['id']));
    }
    require "../app/View/Home.php";
  }
}