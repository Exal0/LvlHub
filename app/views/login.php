<?php 

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST')

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty('username')) {
        $erreurs[] = "Veuillez rentrer un nom d'utilisateur";
    }
     if (empty('password')) {
        $erreurs[] = "Veuillez rentrer un Mot de passe";
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <form action="#" method = "Post">

        <input type="text" name ="username" placeholder="Rentrez votre pseudo" id = "value">

        <input type="password" name="password" placeholder="Mot de passe" id="value">
        </form>
    </main>
</body>
</html>