<?php 
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sheet.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <title>admin space</title>
</head>
<body style="background-color: darkblue;height:100%;">
    <div class="container w-50 mid">
        <form action="../functions/connecter.php" method="POST" class="w-75">
            <label for="user_name" class="anchor pt-3">nom d'utilisateur</label>
            <input type="text" name="user_name" id="user_name"  placeholder="admin" class="form-control">
            <label for="pwd" class="anchor">mot de passe</label>
            <input type="password" name="pwd" id="pwd" placeholder="******"  class="form-control">
            <input type="submit" value="se connecter"  class="form-control bg-primary mt-3 mb-5">
        </form>
    </div>
</body>
</html>