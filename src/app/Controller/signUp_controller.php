<?php
    require_once "../app/Model/sign_up.php";
    class SignUpController{

        public function check(){

            global $error;
            $error = [];

                // ----- sanitize ----- //

            $nickName = filter_var($_POST("nickname"), FILTER_SANITIZE_STRING);
            $email = filter_var($_POST("email"), FILTER_SANITIZE_EMAIL);
            $signature = filter_var($_POST("signature"), FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_var($_POST("password"), FILTER_SANITIZE_SPECIAL_CHARS);

                // ----- Validate ----- //
            if (!filter_var($email)){
                add_error ("email", "This E-mail is invalid");
            }

            if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$/")))){
               add_error ("password", "Please secure your password with min 8 characters, Maj and numbers");
            }
            
            function add_error($value, $message){
                global $error;
                $error[$value] = $message;
            }
            
            if (count($error) > 0 ){
                // require create error page
            }
            else {
                require_once "../view/sign_in.php";
            }
                          
        }
    }