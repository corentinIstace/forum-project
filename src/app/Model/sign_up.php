<?php
    require_once "../app/config/config.php";
    require_once "../app/libraries/DatabaseManager.php";
  
class SignUp extends DatabaseManager{

    public function check(){
        
        if(isset($_POST['submit'])) {
            
            $add_error = array();
            // ----- sanitize ----- //
            
            $nickName = filter_var($_POST["nickname"], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            $signature = filter_var($_POST["signature"], FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);
            
            // ----- Validate ----- //   
            
            if (false === filter_var($nickName, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.[A-Za-z])(?=.)[A-Za-z]{2,}$/")))){
                $add_error["nickname"] = "Invalid nickname <br>";
            }
            
            if(false === filter_var($email, FILTER_VALIDATE_EMAIL)) { 
                $add_error["email"] = "Invalid E-mail <br>";
            }
            
            if (false === filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.[A-Za-z])[A-Za-z\d]{8,}$/")))){
                $add_error["password"] = "Please secure your password with min 8 characters, Maj and numbers <br>";
            }
                
                if (count($add_error)> 0){
                    echo "There are mistakes, please check your Data! <br>";
                    foreach($add_error as $value){
                        echo $value;
                    }
                    exit;
                }
            
        }
    }       
            
    public function store(){
        if((isset($_POST['submit']))){

            if(isset($_POST["nickname"])){
                $nickname = $_POST["nickname"];
            };
            if(isset($_POST['email'])){
                $email = $_POST['email'];
            };
            if(isset($_POST["password"])){
                $password = $_POST["password"];
            };
            if(isset($_POST["signature"])){
                $signature = $_POST["signature"];
            };
            $avatar = "img";

                try{
                    
                    $data = [
                        ':nickname' => $nickname,
                        ':email' => $email,
                        ':password' => $password,
                        ':signature' => $signature,
                        ':avatar' => $avatar,
                    ];
                    
                    // Instantiate access to the database and return the access object
                    $db = $this->connectDb();
                    // Throw exceptions when SQL errors are caused                    
                    
                    $sql = "INSERT INTO users (nickname, email, password, signature, avatar) 
                        VALUES (:nickname, :email, :password, :signature, :avatar)";
                    // insert in database sans la lancé
                    $req = $db->prepare($sql);
                    // lance la requete avec le tableau $data
                    $connexion = $req->execute($data);
                    if ($connexion){
                        header("Location:../app/index.php?page=sign_in");  
                    }
                    
            } 
                // check if we have errors
            catch(PDOException $e){
                    // check if we have duplicate value 
                if($e -> errorInfo[1] == 1062){
                        
                    //    The connection failed, return the faillure message
                    die('Error This nickname or email is already created : <br>'.$e -> getMessage());
                }
                else{
                    echo "Other error happend" . $e -> getMessage();
                }
            }    
        }
    }   
};
