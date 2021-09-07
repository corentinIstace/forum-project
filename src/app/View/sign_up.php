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

    <form method="POST" action="">
        <label for="avatar">Choose a profile picture:</label>
            <input type="file" name="avatar" accept="image/png, image/jpeg">
    <hr width="25%">
        <label for="firstname">Firstname:</label>
            <input type="text" name="firstname">
        <label for="lastname">Lastname:</label>
            <input type="text" name="lastname">
        <label for="signature">Signature:</label>
            <input type="text" name="signature">
    <hr width="25%">
        <label for="nickname">Nickname:</label>
            <input type="text" name="nickname">
        <label for="email">E-mail:</label>
            <input type="email" name="email">
        <label for="password">Password:</label>
            <input type="password" name="password">
    <hr width="25%">
        <input type="submit" name="submit" value="Created acount.">
    </form>
    
</body>
</html>