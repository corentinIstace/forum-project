<?php

declare(strict_types=1);

require_once '../app/Model/Topic.php';
require_once '../app/Model/Topics.php';
require_once '../app/Model/Messages.php';
require_once '../app/Model/Boards.php';
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

  // User clicked create bew topic, function call form view to create it
  public function createTopic()
  {
    // Sanitize
    $board_id = isset($_GET['boardid']) ? filter_var(trim($_GET['boardid']), FILTER_SANITIZE_NUMBER_INT) : null;
    // Validate
    $board_id = filter_var($board_id, FILTER_VALIDATE_INT);
    if (!$board_id) {
      $this->addError("id", "Invalid");
    }
    if (!$this->isValide()) {
      return false;
    }
    $model = new Boards;
    $board = $model->getSingleBoard($board_id);
    // Display new topic form view
    require '../app/View/topics/newTopic.php';
  }

  // User send data to add a new topic from the form
  // Apply validation then display topic
  public function addTopic()
  {
    // Sanitize
    $board_id = isset($_POST['board_id']) ? filter_var(trim($_POST['board_id']), FILTER_SANITIZE_NUMBER_INT) : null;
    $title = isset($_POST['title']) ? filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING) : null;
    $message = isset($_POST['message']) ? filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING) : null;
    // Validate
    $board_id = filter_var($board_id, FILTER_VALIDATE_INT);
    $author_id = $_SESSION['user_id'] ?? null;
    if (!$board_id) {
      $this->addError("id", "Invalid");
    }
    if (!$title) {
      $this->addError("title", "Invalid");
    }
    if (!$message) {
      $this->addError("message", "Invalid");
    }
    if (!$author_id) {
      $this->addError("session", "Disconnected");
    }
    if (!$this->isValide()) {
      return false;
    }
    // Proceed to create the topic and the message
    $model = new Topics();
    $topic_id = $model->setTopic([
      'title' => $title,
      'author_id' => $author_id,
      'board_id' => $board_id
    ]);
    $model = new Messages();
    $model->setMessage([
      'author_id' => $author_id,
      'topic_id' => $topic_id,
      'message' => $message
    ]);
    header("Location:index.php?page=category&id=$board_id");
  }
}
