<?php

require_once '../app/Model/UserSession.php';
require_once '../app/Model/Users.php';

define("MAX_BYTE_SIZE", 65535);

class UserController
{
  public function displayProfile()
  {
    $userSession = new UserSession();
    if(!isset($_SESSION) || !isset($_SESSION['user_id'])){
      echo "You are disconnected.";
      return;
    }
    // Check if the user is sending an avatar and process it
    if(isset($_POST) && isset($_POST['avatar'])){
      $this::updateAvatar($_SESSION['user_id'], $_POST['avatar']);
    }
    // Update avatar in session
    $model = new Users();
    $user = $model->getUSer($_SESSION['user_id']);
    $avatar = $model->getAvatar($user);
    //$_SESSION['user_avatar'] = $model->getAvatar($user);
    require "../app/View/users/profilPage.php";
  }

  // Valid existence of user then call model to get its avatar
  public function getAvatar($id)
  {
    // Check if id is valid then if user exist
    $id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
    if(!$id){// TODO errors
      echo "ID invalid";
      return false;
    }
    $model = new Users;
    $user = $model->getUser($id);
    if(!$user){// TODO errors
      echo "User not found";
      return false;
    }
    
    return $model->getAvatar($user);
  }

  public function updateAvatar($id, $avatar)
  {
    // Check if id is valid then if user exist
    $id = $id ? filter_var(trim($id, FILTER_SANITIZE_NUMBER_INT)) : null;
    if(!$id){// TODO errors
      echo "ID invalid";
      return;
    }
    $model = new Users;
    $user = $model->getUser($id);
    if(!$user){// TODO errors
      echo "User not found";
      return;
    }
    // Get posted avatar, sanitize, compress and validate it then proceed to update
    $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : null;
    $avatar = $this::validateAvatar($model->compressAvatar($this::sanitizeAvatar($avatar)));
    if(!$avatar){ // TODO errors
      return false;
    }

    $model->setAvatar($id, $avatar);
  }

  // Get an avatar url and return it sanitized
  public function sanitizeAvatar($avatar)
  {
    if(!$avatar) { return false; }// TODO errors
    $avatar = filter_var($avatar, FILTER_SANITIZE_STRING);
    return $avatar;
  }

  // Get an avatar url and make validation on length
  public function validateAvatar($avatar)
  {
    if(gettype($avatar) != "string") { echo "<br>An error occured during conversion of the image."; }// TODO errors
    if(strlen($avatar) > MAX_BYTE_SIZE) { echo "<br>Failed size validation : " . strlen($avatar) . " " . MAX_BYTE_SIZE; }// TODO errors
    if(!$avatar || $avatar == "") { return false; }
    if(gettype($avatar) != "string" || strlen($avatar) > MAX_BYTE_SIZE) { return false; }
    return $avatar;
  }
}