<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
    @csrf
    <div class="centering">
        <div class="formulaireCo">
            <form action="{{ route('usagers.store') }}" method="post">
            
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" name="username" value="" placeholder="Utilisateur"><br>
              
                <label for="email">adresse courriel:</label>
                <input type="text" name="email" value="" placeholder="Adresse courriel"><br>

                <label for="email">Nom:</label>
                <input type="text" name="nom" value="" placeholder="Nom"><br>

                <label for="email">Prénom:</label>
                <input type="text" name="prenom" value="" placeholder="Prénom"><br>

                                <label for="domaine_etude">Domaine d'étude:</label>
                <select name="domaine_etude" id="domaine_etude">
                    @foreach($domainesEtude as $domaine)
                        <option value="{{ $domaine->id }}">{{ $domaine->nomDomaine }}</option>
                    @endforeach
                </select>

                
                <label for="password">Mot de Passe:</label>
                <input type="password" name="password" value="" placeholder="Mot de Passe"><br>
        
                <label for="password">Confirmer le mot de Passe:</label>
                <input type="password" name="confirmpassword" value="" placeholder="Confirmer le mot de Passe"><br>

                <label for="role">Type de compte</label>
                <input type="radio" class="form-control" id="role" name="role" value="eleve">
                <label for="role" id="role" name="role">Eleve</label>
                
                <input type="submit" value="S'inscrire">
            </form> 
            <a href="/">Se connecter</a>
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

