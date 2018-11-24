<?php

function print_LOGO_FORMSEARCH_MENU() {
echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Plateforme sur la Basilique de Saint-Denis</title>
  <meta charset="utf-8">
  <meta name="description" content="Plateforme sur la Basilique de Saint-Denis">
  <meta name="keywords" content="cathédrale, jésus, Christ, basilique, stalle, Vierge-Marie, vitraux, cercueil, vitrail, nef, choeur">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/footer.css"><!-- pour le footer ?? -->';
  if(basename($_SERVER['PHP_SELF']) == "faq.php")  {
      echo '<link rel="stylesheet" href="css/reset.css"><!-- pour la FAQ -->
      <link rel="stylesheet" href="css/style.css"><!-- pour la FAQ -->
      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css"><!-- pour la FAQ -->
      <script src="js/jquery-2.1.1.js"></script><!-- pour la FAQ -->
      <script src="js/jquery.mobile.custom.min.js"></script><!-- pour la FAQ -->
      <script src="js/main.js"></script><!-- pour la FAQ -->
      <script src="js/modernizr.js"></script><!-- pour la FAQ -->';
  }
echo '
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Plateforme sur la Basilique de Saint-Denis</a>
    </div>
    <ul class="nav navbar-nav">';
    if(basename($_SERVER['PHP_SELF']) == "index.php")  {
        echo '<li class="active">';
    } else {
        echo '<li>';
    }
    echo '
      <a href="index.php">Accueil</a></li>';
      if(basename($_SERVER['PHP_SELF']) == "galerie.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="galerie.php">Galerie</a></li>';
      if(basename($_SERVER['PHP_SELF']) == "texts.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="texts.php">Textes</a></li>';
      if(basename($_SERVER['PHP_SELF']) == "faq.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="faq.php">FAQ</a></li>';
      if(basename($_SERVER['PHP_SELF']) == "about.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="about.php">A propos de</a></li>';


    if($_COOKIE["the_username"]) {
    echo
      '<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Upload
        <span class="caret"></span></a>
        <ul class="dropdown-menu">';
        if(basename($_SERVER['PHP_SELF']) == "upload_chapelle.php")  {
          echo '<li class="active">';
        } else {
          echo '<li>';
        }
        echo '<a href="upload_chapelle.php">Upload de chapelles</a>
        </li>';
        if(basename($_SERVER['PHP_SELF']) == "chapelle_a_valider.php")  {
          echo '<li class="active">';
        } else {
          echo '<li>';
        }
        echo '<a href="chapelle_a_valider.php">Chapelles à valider</a>
        </li>';
        if(basename($_SERVER['PHP_SELF']) == "upload_personnalite.php")  {
          echo '<li class="active">';
        } else {
          echo '<li>';
        }
        echo '<a href="upload_personnalite.php">Upload de personnalité</a>
        </li>';
          if(basename($_SERVER['PHP_SELF']) == "personnalite_a_valider.php")  {
              echo '<li class="active">';
          } else {
              echo '<li>';
          }
          echo '<a href="personnalite_a_valider.php">Personnalité à valider</a>
          </li>';
          if(basename($_SERVER['PHP_SELF']) == "personnalite_a_modifier.php")  {
              echo '<li class="active">';
          } else {
              echo '<li>';
          }
          echo '<a href="personnalite_a_modifier.php">Personnalité à modifier</a></li>
        </ul>
      </li>
      ';
    }
    echo '</ul>
    <form class="navbar-form navbar-left" action="search.php">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
    <ul class="nav navbar-nav navbar-right">';

    if($_COOKIE["the_username"]) {
          if(basename($_SERVER['PHP_SELF']) == "upload_texte.php")  {
              echo '<li class="active">';
          } else {
              echo '<li>';
          }
          echo '<a href="upload_texte.php">Téléversement de texte</a></li>';
          if(basename($_SERVER['PHP_SELF']) == "upload_image.php")  {
              echo '<li class="active">';
          } else {
              echo '<li>';
          }
          echo '<a href="upload_image.php">Téléversement d\'image</a></li>';
          echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Déconnexion</a></li>';

    } else {
          echo '
          <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Enregistrement</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
          ';
    }
    echo '</ul>
  </div>
</nav>
<div class="container"><img src="img/logo-basilique-st-denis-250.png"</div>';
}

?>
