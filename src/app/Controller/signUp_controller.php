<?php

require_once "../Model/sign_up.php";

    class SignUpController{

        public function check(){

            $error = array();

                // ----- sanitize ----- //

            $nickName = filter_var($_POST("nickname"), FILTER_SANITIZE_STRING);
            $email = filter_var($_POST("email"), FILTER_SANITIZE_EMAIL);
            $signature = filter_var($_POST("signature"), FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_var($_POST("password"), FILTER_SANITIZE_SPECIAL_CHARS);

                // ----- Validate ----- //

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { add_error("email", "Invalid E-mail"); }


            if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$/")))){
               add_error ("password", "Please secure your password with min 8 characters, Maj and numbers");
            }
            
            
            if (count($error) > 0 ){
                echo "error in form";
            }
            else {
                require_once "../view/sign_in.php";
            }                 
            function add_error($value, $message){
                
                $error[$value] = $message;
            }
        }
    }
   
