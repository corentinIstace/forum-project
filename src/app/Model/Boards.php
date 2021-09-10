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

  public function getBoards(){
    $data = $this->fetchBoards();
    return $data;
  }

  private function fetchSingleBoard($id){
    $db = $this->connectDb();
      $req = $db->prepare("SELECT * FROM boards WHERE id=:id");
      $req->execute(["id" => $id]);
      return $req->fetch(PDO::FETCH_ASSOC);
  }

  public function getSingleBoard($id){
    $data = $this->fetchSingleBoard($id);
    return $data;
  }

  private function insertBoard($board){
    $db = $this->connectDb();
    $req = $db->prepare("INSERT INTO boards (name, description) VALUES (:name, :description)");
    $req->execute($board);
  }

  public function setBoard($board){
    // Get only name and description, ignore empty id
    $board = [
      'name' => $board['name'],
      'description' => $board['description']
    ];
    $this->insertBoard($board);
  }

  private function updateBoard($board){
    $db = $this->connectDb();
    $req = $db->prepare("UPDATE boards 
                        SET name=:name, description=:description
                        WHERE id=:id");
    $req->execute($board);
  }

  public function editBoard($board){
    $this->updateBoard($board);
  }
}