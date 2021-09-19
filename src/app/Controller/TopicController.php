<?php

declare(strict_types=1);

require_once '../app/Model/Topic.php';
require_once '../app/Model/Topics.php';
require_once '../app/Model/Messages.php';
require_once '../app/Controller/MessageController.php';

class TopicController
{
  private $errors = array();

  private function addError($value, $message)
  {
    $this->errors[$value] = $message;
  }

  private function isValide()
  {
    if (count($this->errors) > 0) {
      // Some errors where detected, whe display them and cancel insertion
      // TODO use a error view instead
      echo "<pre>";
      print_r($this->errors);
      echo "</pre>";
      return false;
    }
    return true;
  }

  public function getHomeTopics($id)
  {
    // When showing the list of the Boards, you need to show the last Topics: the three one with the most recent Message.
    $model = new Topics();
    return $model->getHomeTopics($id);
  }

  public function displayTopic()
  {
    // Check if a valid id is sent then display the topic view
    $topic_id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
    $topic_id = filter_var($topic_id, FILTER_VALIDATE_INT);
    if (!$topic_id) {
      $this->addError("id", "Invalid");
    }
    if (!$this->isValide()) {
      return false;
    }
    // If incoming post data, call MessageController to handle new message
    if(isset($_POST) && isset($_POST['message'])){
      (new MessageController())->addMessage($topic_id);
    }

    // Get the topic and its messages then display the view
    $model = new Topics();
    $topic = $model->getSingleTopic($topic_id);
    $model = new Messages();
    $messages = $model->getMessages($topic_id);
    // Get author nickname for each message
    $model = new Users();
    $messageNumber = count($messages);
    for( $i = 0 ; $i < $messageNumber ; $i++ ){
      $messages[$i]['author'] = $model->getUser($messages[$i]['author_id'])['nickname'];
    }
    require '../app/View/topics/topic.php';
  }

  /* public function replyTopic()
  {
    // Check if a valid id is sent then display the reply form
    $message = filter_has_var(INPUT_GET, 'message') ? filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING) : null;
    if (!$message) {
      $this->addError("message", "Invalid");
    }
    if (!$this->isValide()) {
      return false;
    }
    $model = new Topics();
    //$topic = $model->getSingleTopic($id);
    $model = new Messages();

  } */
}
