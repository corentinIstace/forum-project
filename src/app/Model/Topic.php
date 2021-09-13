<?php

declare(strict_types=1);

class Topic
{
  public $id;
  public $title;
  public $creation_date;
  public $author_id;
  public $board_id;
  public $isLocked;

  public function __construct(int $id, string $title, date $creation_date, int $author_id, int $board_id, bool $isLocked)
  {
    $this->id = $id;
    $this->title = $title;
    $this->creation_date = $creation_date;
    $this->author_id = $author_id;
    $this->board_id = $board_id;
    $this->isLocked = $isLocked;
  }
}