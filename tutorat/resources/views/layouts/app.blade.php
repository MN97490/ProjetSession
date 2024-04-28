<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="{{ asset('js/fullcalendar/main.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('../style.css') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('img/apple-icon-72x72.png') }}"/>
</head>
 

  <script src="{{ asset('js/main.js') }}"></script>
</head>
<body>
  @auth

  <div class="wrapper">


    <!-- HEADER -->
    <header>
      
    <div class="netflixLogo">
        <a class="CegepLogo" href="/index"><img src="{{ asset('img/logoCegepNoBg.png') }}" alt="Logo Image"></a>
      </div> 
        
      <nav class="main-nav">     
     
        <a href="/index">Accueil</a>
        <a href="">Messagerie</a>
       
      
 
        
      <a href="/tutorat">Recherche Tuteur</a>
      <a href="devenirTuteur">Tutorat</a>
 
    
        <a href="/profil">Profil</a>
        @role('admin')
        <a href="/usagers/liste">Panneau Administration</a>
        <a href="/gestionSondage">Gestion Sondages</a>
        @endrole
        <a href="/calendrier">Mes disponibilités</a>
        <a href="/rencontres">Mes rencontres</a>

       @if(auth()->user()->is_tuteur) 
         <a href="/remuneration/check">Ma rémunération</a>
       @endif
        
        
        @role('admin','prof')
        <a href="/domaines/indexProf">Gestion Domaine Étude</a>

        @endrole
        <a href=""><i class="fas fa-bell sub-nav-logo"></i></a>
        
        <a href="#" onclick="toggleSearch(); return false;"><i class="fas fa-search sub-nav-logo"></i></a>

        <div id="searchBar" style="display:none;">
        <h2 class="barrecherche">Rechercher des utilisateurs dans votre domaine d'étude</h2>
        <form action="{{ route('Usagers.recherche') }}" method="GET">
          <input type="text" name="search" placeholder="Rechercher par nom...">
          <button type="submit">Rechercher</button>
        </form>
      </div>
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

    
    <!-- FOOTER -->
    <footer>
    <div class="footerConnect">
        <div class="footerContent">
            <img src="{{ asset('img/logoCegepNoBg.png') }}" class="logocegepFooter" alt="logocegep">
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

<script>

function toggleSearch() {
    var searchBar = document.getElementById("searchBar");
    if (searchBar.style.display === 'none' || searchBar.style.display === '') {
        searchBar.style.display = 'block';
    } else {
        searchBar.style.display = 'none';
    }
}

</script>
