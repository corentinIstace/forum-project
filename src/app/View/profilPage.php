<?php
    session_start(); 
    require_once "../config/config.php";
    require_once "../libraries/DatabaseManager.php";
    
    $id = $_SESSION['sess_user_id'];
    $nickname = $_SESSION['sess_user_nickname'];
    $email = $_SESSION['sess_user_email'];
    $password = $_SESSION['sess_user_password'];
    $signature = $_SESSION['sess_user_signature'];
    
    class UserSession extends DatabaseManager{
        
        public function logout(){
            if(isset($_POST['logout'])){
                session_destroy();
                header("Location: /public");
            }

        }
    }

    $user = new UserSession();
    $user -> logout();






        // if (isset($_POST['submit']))
        // {
        //     try {
        //         $db = new PDO('mysql:host=mysql;dbname=forum-project;', 'root', 'root');
        //     }
        //     catch(PDOException $e){
        //         echo $e -> getMessage();
        //         exit();
        //     }

        //     $id = $_POST['id'];
        //     $nickname = $_POST['nickname'];
        //     $newNickname = $_POST['new_nickname'];

        //     $query = ("UPDATE users set `nickname`=:nickname, `id`=:id");
        //     $pdoResult = $db -> prepare($query);
        //     $pdoResult -> execute( array(":nickname" => $newNickname,
        //                                                 ":id"=> $id));
        //     if ($pdoResult){
        //         echo "<script>alert('data updated')</script>";    
        //     }
        //     else {
        //         echo "error no update";
        //     }
               
        // }
        
               
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
                <li><a href="../View/Home.php">Home</a></li>
                <li><a href="#name_change">Nickname's change</a> </li>
                <li><a href="#password_change">Password's change</a> </li>
                <li><a href="#avatar_change">Avatar's change</a> </li>
                <li><a href="#activities">Activities</a></li>
                <form method="POST" action="profilPage.php">
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
            <form method="post" action="profilPage.php">
                <label for="id">ID</label>
                <input type='number' name='id'><br><br>
                <label for="nickname">Current nickname</label>
                <input type='text' name='nickname'><br><br>
                <label for="new_nickname">New nickname</label>
                <input type='text' name='new_nickname'><br><br>
                <input type='submit' name='change' value='Change Nickname'>
            </form> 
        </section>
        
        <section id="password_change">
        <h2>Change your password:</h2>
            <form method="post" action="profilPage.php">
                <label for="password">Current password</label>
                    <input type='text' name='password'><br><br>
                <label for="new_password">New password</label>
                    <input type='text' name='new_password'><br><br>
                 <input type='submit' name='change' value='Change password'>
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