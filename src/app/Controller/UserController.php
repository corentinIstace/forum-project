<?php
declare(strict_types=1);

require_once '../app/Model/User.php';
require_once '../app/Model/Users.php';

class UserController
{
    public function displayProfile()
    {
      // Get data from Boards, Topics
      require "../app/View/profilPage.php";
    }
}