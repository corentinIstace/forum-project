<?php
    //session_start(); // session already started
    require_once "../app/config/config.php";
    require_once "../app/libraries/DatabaseManager.php";
    
    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
    };
    if(isset($_SESSION['user_nickname'])){
        $nickname = $_SESSION['user_nickname'];
    };
    if(isset($_SESSION['user_email'])){
        $email = $_SESSION['user_email'];
    };
    if(isset($_SESSION['user_password'])){
        $password = $_SESSION['user_password'];
    };
    if(isset($_SESSION['user_signature'])){
        $signature = $_SESSION['user_signature'];
    };
   
    class UserSession extends DatabaseManager{
        
        public function logout(){
            if(isset($_POST['logout'])){
                session_destroy();
                header("Location:../app/index.php?page=home");
            }
        }

        public function changeNickname(){
            if(isset($_POST['changeName'])){

                // connect to the bookdb database
                $db = $this->connectDb();
                $data = [
                    ':id' => $_SESSION['user_id'],
                    ':nickname' => $_POST['new_nickname']
                ];
                $sql = 'UPDATE users SET nickname = :nickname WHERE id = :id'; 
                // prepare statement
                $statement = $db->prepare($sql);
                // execute the UPDATE statment
                if ($statement->execute($data)) {
                    echo 'The name has been updated successfully!';
                }   
            }
        }
        public function changePassword(){
            if(isset($_POST['changePassword'])){

                // connect to the bookdb database
                $db = $this->connectDb();
                $data = [
                    ':id' => $_SESSION['user_id'],
                    ':password' => $_POST['new_password']
                ];
                $sql = 'UPDATE users SET password = :password WHERE id = :id'; 
                // prepare statement
                $statement = $db->prepare($sql);
                // execute the UPDATE statment
                if ($statement->execute($data)) {
                    echo 'The password has been updated successfully!';
                }   
            }
        }
    }

    $user = new UserSession();
    $user -> logout();
    $user -> changeNickname();
    $user -> changePassword();
               
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>profil Page</title>
    </head>
    <body>
        <header>
            <h1>Welcome <?= $nickname ?></h1>
            <img src="" alt="img avatar">
        </header>
        <nav>
            <ul>
                <li><a href="../app/index.php?page=home">Home</a></li>
                <li><a href="#name_change">Nickname's change</a> </li>
                <li><a href="#password_change">Password's change</a> </li>
                <li><a href="#avatar_change">Avatar's change</a> </li>
                <li><a href="#activities">Activities</a></li>
                <form method="POST" action="../app/index.php?page=profile">
                    <input type="submit" name="logout" value="Logout">
                </form>
            </ul>
        </nav>
        <section id="data">
            <h5>Your ID number is : <?= $id ?></h5>
            <h5>Your nickname is : <?= $nickname ?></h5>
            <h5>Your e-mail address is : <?= $email ?></h5>
            <h5>Your password is : <?= $password ?></h5>
            <h5>Your signature is : <?= $signature ?></h5>
        </section>
        <section id="name_change">
            <h2>Change your Nickname:</h2>
            <form method="post" action="../app/index.php?page=profile">
                <label for="id">ID</label>
                <input type='number' name='id'><br><br>
                <label for="nickname">Current nickname</label>
                <input type='text' name='nickname'><br><br>
                <label for="new_nickname">New nickname</label>
                <input type='text' name='new_nickname'><br><br>
                <input type='submit' name='changeName' value='Change Nickname'>
            </form> 
        </section>
        
        <section id="password_change">
        <h2>Change your password:</h2>
            <form method="post" action="../app/index.php?page=profile">
                <label for="password">Current password</label>
                    <input type='text' name='password'><br><br>
                <label for="new_password">New password</label>
                    <input type='text' name='new_password'><br><br>
                 <input type='submit' name='changePassword' value='Change password'>
            </form> 
        </section>
        
        <section id="avatar_change">
        <h2>Change your avatar:</h2>
        </section>
        
        <section id="activities">
        <h2>Your Activities:</h2>
        
        </section>
        </body>
        </html>