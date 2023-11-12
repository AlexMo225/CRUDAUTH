<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Inscription</h1>
    
    <?php
    

    $name = $email = $password = "";
    $name_err = $email_err = $password_err = "";

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty(trim($_POST["name"]))) {
            $name_err = "Veuillez entrer votre nom.";
        } else {
            $name = trim($_POST["name"]);
        }

       
        if (empty(trim($_POST["email"]))) {
            $email_err = "Veuillez entrer votre adresse e-mail.";
        } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            $email_err = "Veuillez entrer une adresse e-mail valide.";
        } else {
            $email = trim($_POST["email"]);
        }

       
        if (empty(trim($_POST["password"]))) {
            $password_err = "Veuillez entrer votre mot de passe.";
        } elseif (strlen(trim($_POST["password"])) < 8) {
            $password_err = "Le mot de passe doit contenir au moins 8 caractères.";
        } else {
            $password = trim($_POST["password"]);
        }

        
        if (empty($name_err) && empty($email_err) && empty($password_err)) {
            
            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
               
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

               
                mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);

                
                if (mysqli_stmt_execute($stmt)) {
                    header("location: login.php");
                    exit();
                } else {
                    echo "Une erreur s'est produite. Veuillez réessayer plus tard.";
                }

                
                mysqli_stmt_close($stmt);
            }
        }

        
        mysqli_close($link);
    }
    ?>

    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>">
        <span><?php echo $name_err; ?></span><br>

        <label for="email">Adresse e-mail :</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>">
        <span><?php echo $email_err; ?></span><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password">
        <span><?php echo $password_err; ?></span><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
