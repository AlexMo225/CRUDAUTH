<?php 

session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== "1") {
   
   
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Transaction</title>
</head>
<body>
    <p>
        <?php
            session_start();
            isset($_SESSION['message']['connexion'])?$_SESSION['message']['connexion']:' ';
        ?>
    </p>
</body>
</html>