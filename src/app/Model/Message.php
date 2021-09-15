<?php

declare(strict_types=1);

class Message
{
    public $id;
    public $title;
    public $creation_date;
    public $author_id;
    public $board_id;
    public $message_content;

    public function post_messages(int $id, string $title,  $creation_date, int $author_id, int $board_id, int $message_content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->creation_date = $creation_date;
        $this->author_id = $author_id;
        $this->board_id = $board_id;
        $this->message_content = $message_content;
    }
}
