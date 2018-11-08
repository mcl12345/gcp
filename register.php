<?php



include("connection_bdd.php");

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
                <li class="nav-item active">
                  <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
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

function formulaire_register_HTML() {
    echo "<form method='post' action='register.php'>
              <label for='username'>Username : </label><input id='username' name='username' type='text' required /><br />
              <label for='email'>Email : </label><input id='email' name='email' placeholder='joe@example.com' type='text' required /><br />
              <label for='plain_password'>Password : </label><input id='plain_password' name='plain_password' id='plain_password' type='password' required /><br />
              <label for='confirm_plain_password'>Confirm the password : </label><input id='confirm_plain_password' name='confirm_plain_password' type='password' required /><br />
              <label for='role'>Rôle : </label><select name ='role'>
                      <option value='administrateur'>Administrateur</option>
                      <option value='utilisateur'>Utilisateur</option>
              </select><br /><br />
              <label for='token_admin'>Token admin : </label><input id='token_admin' name ='token_admin' type='text' placeholder='1234' /><br /><br />
              <input type='submit' value='Envoyer' />
    </form>";
}


// Ici on vérifie si l'utilisateur s'est correctement enregistré
if( !empty($_POST["username"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["plain_password"]) &&
    !empty($_POST["confirm_plain_password"]) &&
    !empty($_POST["role"]) &&
    $_POST["plain_password"] == $_POST["confirm_plain_password"]) {

      //  On sauvegarde les variables
      $my_username = $_POST['username'];
      $my_email = $_POST['email'];
      $my_password_encoded = md5($_POST['plain_password']);
      $my_role = $_POST['role'];
      $token_admin = $_POST['token_admin'];

      if (($my_role == "administrateur" && $token_admin == 1990) || $my_role == "utilisateur") {
          // Vérification :
          $bool_verification_email = true;
          $bool_verification_username = true;
          try {
              $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
              $stmt = $pdo->query('SELECT * FROM user');
              while ($row = $stmt->fetch()) {
                  if($row['email'] == $my_email) {
                      $bool_verification_email = false;
                  }
                  if($row['username'] == $my_username) {
                      $bool_verification_username = false;
                  }
              }
          } catch(PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
          }

          // Ce compte n'existe pas , on le créée
          if($bool_verification_email == true && $bool_verification_username == true) {

              // Insertion MySQL
              try {
                 $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                 // set the PDO error mode to exception
                 $stmt = $pdo->prepare("INSERT INTO user (username, email, password_encoded, role)  VALUES (:username, :email, :password_encoded, :role)");
                 $stmt->bindParam(':username', $my_username);
                 $stmt->bindParam(':email', $my_email);
                 $stmt->bindParam(':password_encoded', $my_password_encoded);
                 $stmt->bindParam(':role', $my_role);
                 $stmt->execute();
                 echo "Enregistrement effectué avec succès !<br />";
              }
              catch(PDOException $e) {
                  echo $sql . "<br>" . $e->getMessage();
              }
          }
          if ($bool_verification_email == false ) {
              echo "Ce compte avec cet email existe déjà.<br />";
          }
          if ($bool_verification_username == false ) {
              echo "Ce compte avec cet username existe déjà.<br />";
          }
      } else {
          // Affichage du logo , du formulaire de recherche et du menu
          print_LOGO_FORMSEARCH_MENU();
          echo "Le token est erroné !<br />";
          formulaire_register_HTML();
      }

      $pdo = null;
}
// On affiche le formulaire
else {
    // Affichage du logo , du formulaire de recherche et du menu
    print_LOGO_FORMSEARCH_MENU();
    formulaire_register_HTML();
}

 ?>
