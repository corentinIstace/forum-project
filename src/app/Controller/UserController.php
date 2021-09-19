<?php

require_once '../app/Model/UserSession.php';

class UserController
{
    public function displayProfile()
    {
      if(!isset($_SESSION) && !isset($_SESSION['user_id'])){
        echo "You are disconnected.";
        return;
      }
      $user = new UserSession();
      require "../app/View/users/profilPage.php";
    }
}