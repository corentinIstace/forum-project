<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


//include all your model files here
//require_once 'Model/Boards.php';
//include all your controllers here
require_once '../app/Controller/BoardController.php';

require_once 'config/config.php';

// Get the current page to load
// If nothing is specified, it will remain empty (home should be loaded)
$page = $_GET['page'] ?? null;

// Load the controller
// It will *control* the rest of the work to load the page
switch ($page) {
  case 'categories': // http://127.0.0.1/public/index.php?page=categories
    (new BoardController())->listBoards();
    break; 
  case 'home':
  default:
    require_once '../app/Controller/HomepageController.php';
    //(new HomepageController())->index();
    //echo "Home";
    break;
}