<?php
if(isset($_POST['submit'])) {
    function check(){
        
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
        
        // if (false === filter_var($signature, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.[A-Za-z])(?=.)[A-Za-z]{2,}$/")))){
            //        $add_error["signature"] = "Invalid signature <br>";
            // }  
            
            if (count($add_error)> 0){
                echo "There are mistakes, please check your Data! <br>";
                foreach($add_error as $value){
                    echo $value;
                }
                exit;
            }
        }
        check();
        
        // echo "<pre>";
        // print_r($_POST);
        
        function store(){
            
            try{
                $textNickname = $_POST["nickname"];
                $textEmail = $_POST["email"];
                $textPassword = $_POST["password"];
                $textSignature = $_POST["signature"];
                $textAvatar = "img";
                $data = [
                    ':textNickname' => $textNickname,
                    ':textEmail' => $textEmail,
                    ':textPassword' => $textPassword,
                    ':textSignature' => $textSignature,
                    ':textAvatar' => $textAvatar,
                ];
                // Instantiate access to the database and return the access object
                $db = new PDO('mysql:host=mysql;dbname=forum-project;', 'root', 'root');
                // Throw exceptions when SQL errors are caused
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                
                $sql = "INSERT INTO users (nickname, email, password, signature, avatar) 
                    VALUES (:textNickname, :textEmail, :textPassword, :textSignature, :textAvatar)";
                // insert in database sans la lancé
                $req = $db->prepare($sql);
                // lance la requete avec le tableau $data
                $connexion = $req->execute($data);
                // require "../View/sign_in.php";
                if ($connexion){
                    header("Location:../index.php?page=sign_in");
                    // echo "<script>alert('Your acount is register successfuly')</script>";    
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
        store();   
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign_up</title>
</head>
<body>
    <h1>Created your acount:</h1>

    <form method="POST" action="../View/sign_up.php">
        <label for="avatar">Choose a profile picture:</label>
            <input type="file" name="avatar" accept="image/png, image/jpeg">
    <hr width="25%">
            <label for="nickname">Nickname:</label>
            <input type="text" name="nickname" >
            <label for="email">E-mail:</label>
            <input type="email" name="email" >
            <label for="signature">Signature:</label>
                <input type="text" name="signature" >
        <label for="password">Password:</label>
            <input type="password" name="password" >
    <hr width="25%">
        <input type="submit" name="submit" value="Created acount.">
    </form>
    </body>
</html>