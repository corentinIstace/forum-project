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

    <form method="POST" action="signup_controller.php">
        <label for="avatar">Choose a profile picture:</label>
            <input type="file" name="avatar" accept="image/png, image/jpeg">
    <hr width="25%">
        <!-- <label for="firstname">Firstname:</label>
            <input type="text" name="firstname" value="">
        <label for="lastname">Lastname:</label>
            <input type="text" name="lastname" value=""> -->
            <label for="nickname">Nickname:</label>
            <input type="text" name="nickname" value="">
            <label for="email">E-mail:</label>
            <input type="email" name="email" value="">
            <label for="signature">Signature:</label>
                <input type="text" name="signature" value="">
        <label for="password">Password:</label>
            <input type="password" name="password" value="">
    <hr width="25%">
        <input type="submit" name="submit" value="Created acount.">
    </form>
    
</body>
</html>