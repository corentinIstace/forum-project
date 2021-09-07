<?php
declare(strict_types=1);

require_once '../app/libraries/DatabaseManager.php';

// Class extending dbManager to define access for the boards table
// Allow to get all boards or a single board. Fetching are private
class Boards extends DatabaseManager
{
  private function fetchBoards(){
    $db = $this->connectDb();

    $req = $db->prepare("SELECT * FROM boards");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  private function fetchSingleBoard($name){
    $db = $this->connectDb();

    $req = $db->prepare("SELECT * FROM boards WHERE name=:name");
    $req->execute(["name" => $name]);
    return $req->fetch(PDO::FETCH_ASSOC);
  }

  public function getBoards(){
    $data = $this->fetchBoards();
    return $data;
  }

  public function getSingleBoard($name){
    $data = $this->fetchSingleBoard($name);
    return $data;
  }
}