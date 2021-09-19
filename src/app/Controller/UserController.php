<?php

require_once '../app/Model/UserSession.php';
require_once '../app/Model/Users.php';

define("MAX_BYTE_SIZE", 65535);

class UserController
{
  public function displayProfile()
  {
    if(!isset($_SESSION) && !isset($_SESSION['user_id'])){
      echo "You are disconnected.";
      return;
    }
    $user = new UserSession();
    /* $model = new Users();
    $avatar = $model->getAvatar($_SESSION['user_id']); */
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
    $id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
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
    $avatar = validateAvatar(compressAvatar(sanitizeAvatar($avatar)));
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
  function validateAvatar($avatar)
  {
    if(gettype($avatar) != "string") { echo "<br>An error occured during conversion of the image."; }// TODO errors
    if(strlen($avatar) > MAX_BYTE_SIZE) { echo "<br>Failed size validation : " . strlen($avatar) . " " . MAX_BYTE_SIZE; }// TODO errors
    if(!$avatar || $avatar == "") { return false; }
    if(gettype($avatar) != "string" || strlen($avatar) > MAX_BYTE_SIZE) { return false; }
    return $avatar;
  }

  // Pass the avatar url in gzdeflate to produce a compressed url string
  function compressAvatar($avatar)
  {
    if(!$avatar) { return false; }
    return gzdeflate($avatar, 6);
  }

  // Get an avatar from DB, uncompress it with gzinflate
  function uncompressAvatar($avatar)
  {
    return gzinflate($avatar);
  }
}