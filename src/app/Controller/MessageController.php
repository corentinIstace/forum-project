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

    private function getValidateMessage($new)
    {
        // Sanitize
        $message_content = isset($_POST['comment_posted']) ? filter_var(trim($_POST['comment_posted']), FILTER_SANITIZE_STRING) : null;
        $author_id = isset($_POST['author_id']) ? filter_var(trim($_POST['author_id']), FILTER_SANITIZE_NUMBER_INT) : null;
        $topic_id = isset($_POST['topic_id']) ? filter_var(trim($_POST['topic_id']), FILTER_SANITIZE_NUMBER_INT) : null;
        // Validate
        if (!$message_content) {
            $this->addError("message", "Invalid");
        }
        if (!$author_id) {
          $this->addError("Author", "Invalid");
        }
        if (!$topic_id) {
          $this->addError("Topic", "Invalid");
        }
        /* if (!$new && !$id) {
            $this->addError("id", "Invalid");
        }*/
        if (count($this->errors) > 0) {
            return false;
        }

        return [
            'author_id' => $author_id,
            'topic_id' => $topic_id
            'message' => $message_content,
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

    public function getAllMessages()
    {
        $model = new Messages;
        return $model->getMessages();
    }

    public function listMessages()
    {
        // Show list of boards or retrieve a clicked board and repath to edit board
        if (!filter_has_var(INPUT_POST, 'id')) {
            // Listing of boards
            // Instantiate boards model (db access) and retrieve data
            $model = new Messages;
            $boards = $model->getMessages();
            // Loop converting array elements into board from the class
            foreach ($messages as $key => $message) {
                $messages[$key] = new Message((int)$message['id'], $message['name'], $message['description'], $message['message']);
            }
            // Load the view
            require '../app/View/boards/ListMessages.php';
        } else {
            $id = filter_has_var(INPUT_POST, 'id') ? filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) : null;
            header("Location:index.php?page=editBoard&id=$id");
        }
    }

    public function addMessage()
    {
        // Send the form view then handle form data for insertion of a message
        if (count($_POST) == 0) {
            // Display form
            require '../app/View/boards/newBoard.php';
        } else {
            // Retrieve data from the form, proceed validation and insertion
            $message = $this->getValidateMessage(TRUE);
            if ($this->isValide()) {
                // Nothing wrong, will proceed the insertion
                $model = new Message;
                $model->setMessage($message);
                // if insert was successful, return to the topic view
                //$model->getLastMessageFrom($id); // TODO SESSION['id']
                header("Location:index.php?page=topic&id=".$message['topic_id']);
            }
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
            $model = new Messages;
            $board = $model->getSingleMessage($id);
            // TODO check if text with spaces can be sent with get
            $_GET['name'] = $message["name"];
            $_GET['description'] = $message["description"];
            require '../app/View/boards/newBoard.php';
        } else {
            $board = $this->getValidateBoard(FALSE);
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
        }
    }
}
