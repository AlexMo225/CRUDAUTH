<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Page de Connexion </h2>
    <form method="post" action="process_login.php">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Se Connecter">
    </form>
</body>
</html>