
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
            <form action="{{ route('usagers.store') }}" method="POST">
            @csrf
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" name="nomUtilisateur"  placeholder="Utilisateur"><br>
              
                <label for="email">adresse courriel:</label>
                <input type="text" name="email" placeholder="Adresse courriel"><br>

                <label for="email">Nom:</label>
                <input type="text" name="nom"  placeholder="Nom"><br>

                <label for="email">Prénom:</label>
                <input type="text" name="prenom" placeholder="Prénom"><br>

                                <label for="domaineetude">Domaine d'étude:</label>
                <select name="domaineEtude" id="domaineetude">
                    @foreach($domainesEtude as $domaine)
                        <option value="{{ $domaine->id }}">{{ $domaine->nomDomaine }}</option>
                    @endforeach
                </select>

                
                <label for="password">Mot de Passe:</label>
                <input type="password" name="password"  placeholder="Mot de Passe"><br>
        
                <label for="password">Confirmer le mot de Passe:</label>
                <input type="password" name="password_confirmation"  placeholder="Confirmer le mot de Passe"><br>

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

