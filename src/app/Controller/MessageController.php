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
        $id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
        $name = filter_has_var(INPUT_POST, 'name') ? filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING) : null;
        $description = filter_has_var(INPUT_POST, 'description') ? filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING) : null;
        $message_content = filter_has_var(INPUT_POST, 'message') ? filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING) : null;
        // Validate
        if (!$name) {
            $this->addError("name", "Invalid");
        }
        if (!$new && !$id) {
            $this->addError("id", "Invalid");
        }
        if (!$message_content && !$id) {
            $this->addError("message", "Invalid");
        }
        if (count($this->errors) > 0) {
            return false;
        }

        // if(!$description) { $this->addError("description", "Invalid"); } // description is optionnal
        return [
            'id' => $id,
            'name' => $name,
            'description' => $description,
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
        // Send the form view then handle form data for insertion of a board
        if (count($_POST) == 0) {
            // Display form
            require '../app/View/boards/newBoard.php';
        } else {
            // Retrieve data from the form, proceed validation and insertion
            $board = $this->getValidateMessage(TRUE);
            if ($this->isValide()) {
                // Nothing wrong, will proceed the insertion then display the list of boards
                $model = new Message;
                $model->setMessage($message);
                header("Location:index.php?page=categories");
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
