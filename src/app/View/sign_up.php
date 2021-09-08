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
        <!-- <label for="firstname">Firstname:</label>
            <input type="text" name="firstname">
        <label for="lastname">Lastname:</label>
            <input type="text" name="lastname"> -->
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
    
    <?php
    function check(){
        
                // ----- sanitize ----- //
        
            $nickName = filter_var($_POST["nickname"], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            $signature = filter_var($_POST["signature"], FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);
        
                // ----- Validate ----- //   

            if(false === filter_var($email, FILTER_VALIDATE_EMAIL)) { 
                echo "Invalid E-mail <br>";
            }
        
            if (false === filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$/")))){
                   echo "Please secure your password with min 8 characters, Maj and numbers <br>";
            }

            if (false === filter_var($nickName, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.[A-Za-z])(?=.)[A-Za-z]{2,}$/")))){
                   echo "Invalid nickname <br>";
            }

            if (false === filter_var($signature, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.[A-Za-z])(?=.)[A-Za-z]{2,}$/")))){
                   echo "Invalid signature <br>";
            }   
        }
        check();
            
            
            echo "<pre>";
            print_r($_POST);
            
            function store(){
                
            }
            function display(){
                
            }
            
            
            ?>
    </body>
</html>