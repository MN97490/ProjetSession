<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../style.css">
  <link rel="shortcut icon" type="image/png" href="../img/apple-icon-72x72.png"/>
</head>
 
  <script src="main.js"></script>
</head>
<body>
  @auth

  <div class="wrapper">


    <!-- HEADER -->
    <header>
      
    <div class="netflixLogo">
        <a class="CegepLogo" href="/index"><img src="../img/logoCegepNoBg.png" alt="Logo Image"></a>
      </div> 
        
      <nav class="main-nav">     
     
        <a href="/index">Accueil</a>
        <a href="">Messagerie</a>
       
      
 
        <a href="">Tutorat</a>
        @unless(Auth::user()->is_tuteur)
      <a href="">Devenir Tuteur</a>
    @endunless
    
        <a href="/profil">Profil</a>
        @role('admin')
        <a href="/usagers/liste">Gestion Utilisateur</a>

        @endrole

        @role('admin','prof')
        <a href="/usagers/liste">Gestion Note</a>

        @endrole
        <a href=""><i class="fas fa-bell sub-nav-logo"></i></a>
     
        @csrf
        
        <form class="deconnexionBtn" action="{{route('Usagers.logout')}}" method="get">
        <p style="color:white"> Connecté en tant que:  <span style="color: rgba(12, 219, 12, 0.877);"> @auth {{ Auth::user()->nomUtilisateur }} @endauth</span></p>
        <input class="deconnexionBtn" type="submit" value="Deconnexion"><br>
        
        
        </form>
        
      
           
      </nav>
         
    </header>

   

    
    <!-- END OF HEADER -->
    
    @yield('contenu')

    <!-- LINKS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- FOOTER -->
    <footer>
    <div class="footerConnect">
        <div class="footerContent">
            <img src="../img/logoCegepNoBg.png" class="logocegepFooter" alt="logocegep">
            <p>© Tous droits réservés - Cégep de Trois-Rivières - 2024</p>
        </div>
    </div>
    </footer>
  </div>
  @else <h1>Veuillez vous connecter!</h1>
  <a href="{{route('login')}}" > Page de connexion</a>
  @endauth
</body>

</html>