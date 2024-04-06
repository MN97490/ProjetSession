<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../style.css">
 
  <script src="main.js"></script>
</head>
<body>
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
        <a href="">Profile</a>
        <a href="#"><i class="fas fa-bell sub-nav-logo"></i></a>
        
        @csrf
        <button  class="deconnexionBtn" type="submit">Déconnexion</button> 
      
           
      </nav>
         
    </header>

   

    
    <!-- END OF HEADER -->
    
    @yield('contenu')

    <!-- LINKS -->

    
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
</body>
</html>