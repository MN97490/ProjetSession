<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="../style.css">
    <title>Connexion</title>
    <link rel="shortcut icon" type="image/png" href="../img/apple-icon-72x72.png"/>
</head>

<body class="bodyConnect">
    <video autoplay muted loop id="background-video">
        <source src="../img/cegeploop.mp4" type="video/mp4">
    </video>

    <div class="centering">
        <div class="formulaireCo">
            <form action="{{route('Usagers.connect')}}" method="post">
            @csrf
                <label style="color:white;" for="username">Utilisateur:</label>
                <input type="text" name="username"  placeholder=" Utilisateur"><br>
                <p style="color:red;"></p>
                <label style="color:white;" for="password">Mot de Passe:</label>
                <input type="password" name="password"  placeholder="Mot de Passe"><br>
                <p style="color:red;"></p>
                @if ($errors->any())
    <div class="alert alert-danger" style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <input  type="submit" value="Connexion"><br>
                <input  style="margin: 5px;" onClick="window.location.href='/usagers/creation'" type="button" Value="Nouvel usager">
                
            </form> 
            
        </div>
    </div>

    <div class="footerConnect">
        <div class="footerContent">
            <img src="../img/logoCegepNoBg.png" class="logocegepFooter" alt="logocegep">
            <p>© Tous droits réservés - Cégep de Trois-Rivières - 2024</p>
        </div>
    </div>
</body>
</html>
