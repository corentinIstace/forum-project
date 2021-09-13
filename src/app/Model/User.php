<?php

declare(strict_types=1);

class User
{
  public $id;
  public $nickname;
  public $avatar;
  public $signature;

  public function __construct(int $id, string $nickname, string $avatar, string $signature)
  {
    $this->id = $id;
    $this->nickname = $nickname;
    $this->avatar = $avatar;
    $this->signature = $signature;
  }
}