<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="../style.css">
    <title>Connexiond</title>
    <link rel="shortcut icon" type="image/png" href="../img/apple-icon-72x72.png"/>
</head>

<body class="bodyConnect">
    <video autoplay muted loop id="background-video">
        <source src="../img/cegeploop.mp4" type="video/mp4">
    </video>

    <div class="centering">
        <div class="formulaireCo">
            <form action="" method="post">
                <label for="username">Utilisateur:</label>
                <input type="text" name="username" value="" placeholder=" Utilisateur"><br>
                <p style="color:red;"></p>
                <label for="password">Mot de Passe:</label>
                <input type="password" name="password" value="" placeholder="Mot de Passe"><br>
                <p style="color:red;"></p>
                <input type="submit" value="Connexion">
            </form> 
        </div>
    </div>

    <div class="footerConnect">
        <div class="footerContent">
            <img src="../img/logoCegepNoBg.png" class="logocegepFooter" alt="logocegep">
            <p>© Tous droits réservés - Cégep de Trois-Rivières - 2023</p>
        </div>
    </div>
</body>
</html>
