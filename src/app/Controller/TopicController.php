<?php
declare(strict_types=1);

require_once '../app/Model/Topic.php';
require_once '../app/Model/Topics.php';

class TopicController
{
  private $errors = array();

  private function addError($value, $message)
  {
    $this->errors[$value] = $message;
  }

  private function isValide()
  {
    if(count($this->errors) > 0){
      // Some errors where detected, whe display them and cancel insertion
      // TODO use a error view instead
      echo "<pre>";
      print_r($this->errors);
      echo "</pre>";
      return false;
    }
    return true;
  }

  public function getHomeTopics()
  {
    // When showing the list of the Boards, you need to show the last Topics: the three one with the most recent Message.
    $model = new Topics();
    return $model->getHomeTopics();
  }

  public function displayTopic()
  {
    // Check if a valid id is sent then display the topic view
    $id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
    if(!$id) { $this->addError("id", "Invalid"); }
    if(!$this->isValide()) { return false; }
    $model = new Topics();
    $topic = $model->getSingleTopic($id);
    // TODO get messages
    $messages = [];
    require '../app/View/topics/topic.php';
  }
}