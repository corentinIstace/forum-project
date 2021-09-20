<?php

declare(strict_types=1);

require_once '../app/Model/Message.php';
require_once '../app/Model/Messages.php';

class MessageController
{
    private $errors = array();

    private function addError($value, $message)
    {
        $this->errors[$value] = $message;
    }

    private function getValidateMessage($new, $topic_id)
    {
        // Sanitize
        $id = isset($_POST['id']) ? filter_var(trim($_POST['id']), FILTER_SANITIZE_NUMBER_INT) : null;
        $message = isset($_POST['message']) ? filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING) : null;

        $author_id = $_SESSION['user_id'];

        if (!$message) {
            $this->addError("message", "Invalid");
        }
        if (!$author_id) {
          $this->addError("Author", "Invalid");
        }
        if (!$topic_id) {
          $this->addError("Topic", "Invalid");
        }
        if (!$new && !$id) {
            $this->addError("id", "Invalid");
        }
        if (count($this->errors) > 0) {
            return false;
        }

        return [
            'id' => $id,
            'author_id' => $author_id,
            'topic_id' => $topic_id,
            'message' => $message,
        ];
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

    public function addMessage($topic_id)
    {
        // Send the form view then handle form data for insertion of a message
        if (isset($_POST) && isset($_POST['message'])) {
            // Retrieve data from the form, proceed validation and insertion
            $message = $this->getValidateMessage(TRUE, $topic_id);
            if ($this->isValide()) {
                // Nothing wrong, will proceed the insertion
                $model = new Messages;
                $model->setMessage($message);
            }
        }
    }

    public function editMessage()
    {
        // If no post incoming data, retrieve board from get id and show prefilled form
        // Else proceed with incoming post data for update
        if (count($_POST) == 0) {
            $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) { /* TODO error */}
            $model = new Messages;
            $board = $model->getSingleMessage($id);
            // TODO check if text with spaces can be sent with get
            $_GET['name'] = $message["name"];
            $_GET['description'] = $message["description"];
            require '../app/View/boards/newBoard.php';
        } else {
            $board = $this->getValidateMessage(FALSE, $id);
            if ($this->isValide()) {
                // Nothing wrong, will proceed the update then display the list of boards
                $model = new Messages;
                $model->Message($message);
                header("Location:index.php?page=categories");
            }
        }
    }

    public function deleteMessage()
    {
        // Check if incoming id is valid 
        // then check if the board exist 
        // then delete it
        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $model = new Messages();
                $board = $model->getSingleMessage($id);
                if ($board['id'] == $id) {
                    $model->deleteMessage($id);
                    header("Location:index.php?page=categories");
                } else { /* TODO error */
                }
            }
            if(!$id) { /* TODO error */}
        }
    }
}
