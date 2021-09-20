<?php

declare(strict_types=1);
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


//include all your model files here
//require_once 'Model/Boards.php';
//include all your controllers here
require_once '../app/Controller/HomepageController.php';
require_once '../app/Controller/BoardController.php';
require_once '../app/Controller/signIn_controller.php';
require_once '../app/Controller/signUp_controller.php';
require_once '../app/Controller/UserController.php';

require_once 'config/config.php';

// Get the current page to load
// If nothing is specified, it will remain empty (home should be loaded)
$page = $_GET['page'] ?? null;
// Load the controller
// It will *control* the rest of the work to load the page
switch ($page) {
  case 'topic':
    (new TopicController())->displayTopic();
    break;
  /* case 'replytopic':
    (new TopicController())->replyTopic();
    break; */
  case 'categories': // http://127.0.0.1/public/index.php?page=categories
    (new BoardController())->listBoards();
    break;
  case 'category':
    (new BoardController())->getSingleBoard();
    break;
  case 'addboard':
    (new BoardController())->addBoard();
    break;
  case 'editBoard':
  case 'updateBoard':
    (new BoardController())->editBoard();
    break;
  case 'newtopic':
    (new TopicController())->createTopic();
    break;
  case 'addtopic':
    (new TopicController())->addTopic();
    break;
  case 'deleteboard':
    (new BoardController())->deleteBoard();
    break;
  case 'sign_up':
      (new SignUpController())->displayPage();
      break;
  case "sign_in":
      (new SignInController())->displayPage();
      break;
  case 'profile':
    (new UserController())->displayProfile(); 
    break;
  case 'logout':
    (new UserSession())->logout();
  case 'home':
  default:
    (new HomepageController())->index();
    break;
}
