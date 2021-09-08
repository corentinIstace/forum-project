<?php

    $nickName = $_POST["nickname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $signature = $_POST["signature"];

    if(!empty($nickName) || !empty($email) || !empty($password) || !empty($signature)){
        require_once "../libraries/DatabaseManager.php";
        echo "acount created";
    } 
    else {
        echo "this fiels is necessary";
    }

    class SignUp {
        public $login;
        public $password;

        public function compare() {

            // ----- Execute ----- //
          
        }
        // if(pas de problème){
        //     require_once "../View/sign_in.php";
        // }
        // else{
        //     echo "error de donées"
        // }
    }
    // echo "eennnffiiin";
    // require_once "../View/sign_in.php";