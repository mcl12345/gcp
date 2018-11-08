<?php

include("connection_bdd.php");

function formulaire_login_HTML() {
    echo "<form method='post' action='login.php'>
            <label for='username'>Username : </label><input id='username' name='username' type='text' required /><br />
            <label for='plain_password'>Password : </label><input id='plain_password' name='plain_password' id='plain_password' type='password' required /><br />
            <input type='submit' value='Connexion' />
    </form>";
}

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
            <img src="img/100px-Saint-Denis.jpg" />
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

    <br /><br />

    <!-- MENU -->
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
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
                <li class="nav-item active">
                  <a class="nav-link" href="login.php">Login</a>
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

// Ici on vérifie si l'utilisateur s'est correctement connecté
if( !empty($_POST["username"]) &&
    !empty($_POST["plain_password"])) {

      // On sauvegarde dans des variables :
      $my_username = $_POST['username'];
      $my_password_encoded = md5($_POST['plain_password']);
      $my_email = "";
      $my_role = "";

      // Verification du bon password selon l'username donné
      $bool_verification_password = false;
      try {
          $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
          $stmt = $pdo->prepare("SELECT * FROM user where username = ?");
          if ($stmt->execute(array($my_username))) {
            while ($row = $stmt->fetch()) {
              if($row['password_encoded'] == $my_password_encoded) {
                  $bool_verification_password = true;
                  $my_email = $row['email'];
                  $my_role = $row['role'];
              }
            }
          }
      } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
      }

      if( $bool_verification_password) {
          // Insertion COOKIES
          setcookie("the_username", $my_username);
          setcookie("the_email", $my_email);
          setcookie("the_password_encoded", $my_password_encoded);
          setcookie("the_role", $my_role);
          echo "Vous êtes bien authentifié en tant que " . $my_username . " !";
      } else {
            print_LOGO_FORMSEARCH_MENU();
            echo "Mauvais password<br />";
            formulaire_login_HTML();
      }
}
else if (isset($_COOKIE['the_username'])) {
    echo "Bienvenue " . $_COOKIE["the_username"] . " !";
} else {
    print_LOGO_FORMSEARCH_MENU();
    formulaire_login_HTML();
}

?>
