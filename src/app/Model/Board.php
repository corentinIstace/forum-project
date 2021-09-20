<?php

// From this declare, for this file, variable types are strict wich mean types must be respected
declare(strict_types=1);

// Define a board object
class Board
{
  public /*int*/ $id;
  public /*string*/ $name;
  public /*?string*/ $description;

  public function __construct(int $id, string $name, ?string $description)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
  }
}