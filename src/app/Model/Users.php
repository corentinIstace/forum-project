<?php
declare(strict_types=1);

require_once '../app/libraries/DatabaseManager.php';
require_once '../app/libraries/Gravatar.php';

// Class extending dbManager to define access for the users table
class Users extends DatabaseManager
{
  // Get user
  public function getUser($id)
  {
    $db = $this->connectDb();
    $req = $db->prepare("SELECT * FROM users WHERE id=:id");
    $req->execute(['id'=>$id]);
    return $req->fetch(PDO::FETCH_ASSOC);
  }

  // Set an avatar to an user
  public function setAvatar($id, $avatar)
  {
    $db = $this->connectDb();
    $req = $db->prepare("UPDATE users
                        SET avatar=:avatar
                        WHERE id=:id");
    $req->execute([
      'id' => $id, 
      'avatar' => $avatar
    ]);
  }

  public function getAvatar($user)
  {
    // get avatar for display
    // If not available in user (from db), get the gravatar's user
    $gravatar = new Gravatar;
    if(!$user['avatar']){
      if($gravatar->setEmail($user['email'])){
        // get from Gratavar
        return $gravatar->getSrc();      
      }
      return "";
    }
    return $this::uncompressAvatar($user['avatar']);
  }

  // Pass the avatar url in gzdeflate to produce a compressed url string
  public function compressAvatar($avatar)
  {
    if(!$avatar) { return false; }
    return gzdeflate($avatar, 6);
  }

  // Get an avatar from DB, uncompress it with gzinflate
  public function uncompressAvatar($avatar)
  {
    return gzinflate($avatar);
  }

  public function changeNickname(){
    if(isset($_POST['changeName'])){
      // connect to the bookdb database
      $db = $this->connectDb();
      $data = [
          'id' => $_SESSION['user_id'],
          'nickname' => $_POST['new_nickname']
      ];
      $sql = 'UPDATE users SET nickname = :nickname WHERE id = :id'; 
      // prepare statement
      $statement = $db->prepare($sql);
      // execute the UPDATE statment
      if ($statement->execute($data)) {
          $sql = 'SELECT nickname FROM users WHERE id = :id'; 
          $statement = $db->prepare($sql);
          $statement->execute($data);
          $_SESSION['user_nickname'] = $_POST['new_nickname'];
          header("Location:../app/index.php?page=profile");
      }   
    }
  }

  public function changePassword(){
    if(isset($_POST['changePassword'])){
      // connect to the bookdb database
      $db = $this->connectDb();
      $data = [
          'id' => $_SESSION['user_id'],
          'password' => $_POST['new_password']
      ];
      $sql = 'UPDATE users SET password = :password WHERE id = :id'; 
      // prepare statement
      $statement = $db->prepare($sql);
      // execute the UPDATE statment
      if ($statement->execute($data)) {
          $sql = 'SELECT password FROM users WHERE id = :id'; 
          $statement = $db->prepare($sql);
          $statement->execute($data);
          $_SESSION['user_password'] = $_POST['new_password'];
          header("Location:../app/index.php?page=profile");
      }   
    }
  }
}