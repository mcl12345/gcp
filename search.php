<?php

function print_LOGO_FORMSEARCH_MENU() {

  echo '<html>
  <head>
  <title>Plateforme sur la Basilique de Saint-Denis</title>
  <meta charset="UTF-8"
    <meta name="description" content="Plateforme sur la Basilique de Saint-Denis">
    <meta name="keywords" content="cathédrale, jésus, Christ, basilique, stalle, Vierge-Marie, vitraux, cercueil, vitrail, nef, choeur">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.1.3/css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.1.3/css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="bootstrap-4.1.3/js/bootstrap.bundle.js"></script>
    <script src="bootstrap-4.1.3/js/bootstrap.js"></script>
  </head>
  <body>
  <br />
      <!-- LOGO + FORM_SEARCH -->
      <div class="row">
        <div class="col-lg-2">
        </div><!-- /.col-lg-2 -->
        <!-- LOGO -->
        <div class="col-lg-2">
          <div class="logo">
            <img src="img/logo-basilique-st-denis-250.png" />
          </div>
        </div><!-- /.col-lg-2 -->
        <!-- search -->
        <div class="col-lg-4">
        <form class="formulaire" method="get" action="search.php">
          <div class="input-group">
                  <input type="text" class="form-control" placeholder="Rechercher...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Rechercher</button>
                  </span>
          </div><!-- /input-group -->
          </form>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
      <!-- end LOGO + FORM_SEARCH -->

    <br />

    <!-- MENU -->
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-5">
          <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="gallery.php">Gallerie</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="texts.php">Textes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="faq.php">FAQ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="api.php">API</a>
                </li>
              </ul>
            </div>
          </nav>
          </div><!-- end of container -->
      </div><!-- class="col-lg-6" -->
    </div><!-- end of the row -->
    <!-- end of MENU -->
  </body>

  </html>';
}

// Affichage du logo , du formulaire de recherche et du menu
print_LOGO_FORMSEARCH_MENU();

//$recherche = $_POST["mon_item"];
// Traitement ...

?>
