<?php

declare(strict_types=1);

require_once '../app/libraries/DatabaseManager.php';

class Messages extends DatabaseManager

{
    public function getMessages()
    {
        $db = $this->connectDb();
        $req = $db->prepare("SELECT * FROM messages ORDER BY id DESC");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    private function fetchMessages($MessagesId)
    {
        $db = $this->connectDb();
        $req = $db->prepare("SELECT * FROM messages WHERE MessagesId = :MessagesId");
        $req->execute(['messagesId' => $MessagesId]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessage($MessagesId)
    {
        $data = $this->fetchMessages($MessagesId);
        return $data;
    }

    private function fetchSingleMessage($id)
    {
        $db = $this->connectDb();
        $req = $db->prepare("SELECT * FROM messages WHERE id=:id");
        $req->execute(["id" => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    private function insertMessage($message)
    {
        $db = $this->connectDb();
        $req = $db->prepare("INSERT INTO messages (title, creation_date, author_id, message_content) 
                                VALUES (:title, :creation_date, :author_id, :board_id),: message_content");
        $req->execute($message);
    }

    public function setmessage($messages)
    {
        $messages = [
            'title' => $messages['title'],
            'creation_date' => $messages['creation_date'],
            'author_id' => $messages['author_id'],
            'message_id' => $messages['message_id'],
            'message_content' => $messages['message_content']
        ];
        $this->insertMessage($messages);
    }
}
