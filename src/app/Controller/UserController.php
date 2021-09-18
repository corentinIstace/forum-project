<?php

require_once '../app/Model/UserSession.php';

class UserController
{
    public function displayProfile()
    {
      $user = new UserSession();
      $user -> logout();
      require "../app/View/users/profilPage.php";
    }
}