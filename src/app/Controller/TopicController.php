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

  public function getHomeTopics($id)
  {
    // When showing the list of the Boards, you need to show the last Topics: the three one with the most recent Message.
    $model = new Topics();
    return $model->getHomeTopics($id);
  }
}