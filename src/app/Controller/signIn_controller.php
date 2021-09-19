<?php
    require_once "../app/Model/SignIn.php";
    
    class SignInController{

        public function displayPage(){
            // Enable connexion
            $signIn = new SignIn();
            $signIn -> connexion();
            require "../app/View/users/sign_in.php";
        }
    }