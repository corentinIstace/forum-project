<?php
declare(strict_types=1);

require_once '../app/libraries/DatabaseManager.php';

// Class extending dbManager to define access for the topics table
class Topics extends DatabaseManager
{
  // TODO adapt to get the 3 last recent topics for each boards
  public function getHomeTopics($board_id){
    $db = $this->connectDb();
    $req = $db->prepare("SELECT * FROM topics WHERE board_id = :board_id ORDER BY creation_date DESC LIMIT 3");
    $req->execute(['board_id' => $board_id]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }
  private function fetchTopics($boardId){
    $db = $this->connectDb();
    // Get topics from newers to elders
    $req = $db->prepare("SELECT * FROM topics WHERE board_id = :board_id ORDER BY id DESC");
    $req->execute(['board_id'=>$boardId]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getTopics($boardId){
    return $this->fetchTopics($boardId);
  }

  private function fetchSingleTopic($id){
    $db = $this->connectDb();
      $req = $db->prepare("SELECT * FROM topics WHERE id=:id");
      $req->execute(["id" => $id]);
      return $req->fetch(PDO::FETCH_ASSOC);
  }

  public function getSingleTopic($id){
    $data = $this->fetchSingletopic($id);
    return $data;
  }

  private function insertTopic($topic){
    $db = $this->connectDb();
    $req = $db->prepare("INSERT INTO topics (title, creation_date, author_id, board_id) 
                          VALUES (:title, :creation_date, :author_id, :board_id)");
    $req->execute($topic);
  }

  public function setTopic($topic){
    // Get only name and description, ignore empty id
    $topic = [
      'title' => $topic['title'],
      'creation_date' => $topic['creation_date'],
      'author_id' => $topic['author_id'],
      'board_id' => $topic['board_id']
    ];
    $this->inserttopic($topic);
  }

  private function updateTopic($topic){
    $db = $this->connectDb();
    $req = $db->prepare("UPDATE topics 
                        SET title=:title, creation_date=:creation_date, author_id=:author_id, board_id=:board_id
                        WHERE id=:id");
    $req->execute($topic);
  }

  public function editTopic($topic){
    $this->updatetopic($topic);
  }

  public function deleteTopic($id){
    $db = $this->connectDb();
    $req = $db->prepare("DELETE FROM topics WHERE id=:id");
    $req->execute(['id'=>$id]);
  }
}