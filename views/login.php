<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<body>
    <h1>Page de Connexion </h1>
    <form method="post" action="process_login.php">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Se Connecter">
    </form>
</body>
</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username = $_POST['username'];
    $password = $_POST['password'];


    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = 'root';
    $dbName = 'schema';

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données: " . $conn->connect_error);
    } else {
        
        $stmt = $conn->prepare("SELECT `password` FROM users WHERE `name` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['message']['connexion'] = 'Connexion réussie !';
            $_SESSION['user_logged_in']="1";
            
            header("Location: transactions.php");
            exit();
        } else {
            $_SESSION['message']['connexion'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
           
            header("Location: log.php");
            exit();
        }

    }
}

?>