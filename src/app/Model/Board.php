<?php

// From this declare, for this file, variable types are strict wich mean types must be respected
declare(strict_types=1);

// Define a board object
class Board
{
  public /*string*/ $name;
  public /*?string*/ $description;

  public function __construct(string $name, ?string $description)
  {
    $this->name = $name;
    $this->description = $description;
  }
}