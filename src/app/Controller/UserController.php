<?php

require_once '../app/Model/User.php';

class UserController
{
    public function displayProfile()
    {
      $user = new UserSession();
      $user -> logout();
      $user -> changeNickname();
      $user -> changePassword();
      require "../app/View/users/profilPage.php";
    }
}