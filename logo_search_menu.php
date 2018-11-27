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
  if($_COOKIE["the_username"]) {
    echo
      '<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Personnalités
        <span class="caret"></span></a>
        <ul class="dropdown-menu">';

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
          echo '<a href="personnalite_a_modifier.php">Personnalité à modifier</a></li>';
          if(basename($_SERVER['PHP_SELF']) == "personnalites.php")  {
              echo '<li class="active">';
          } else {
              echo '<li>';
          }
          echo '<a href="personnalites.php">Personnalités</a></li>';
        echo '</ul>
      </li>
      ';       
  } else {

      if(basename($_SERVER['PHP_SELF']) == "personnalites.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="personnalites.php">Personnalités</a></li>';
     
    }

    if($_COOKIE["the_username"]) {
        echo
          '<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Chapelles
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
      echo '<a href="chapelle_a_valider.php">Chapelles à valider</a></li>';

      if(basename($_SERVER['PHP_SELF']) == "chapelles.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="chapelles.php">Chapelles</a></li>';
      echo '</ul>
      </li>';
    } else {
      if(basename($_SERVER['PHP_SELF']) == "chapelles.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="chapelles.php">Chapelles à découvrir</a></li>';
    }
    
    
  if($_COOKIE["the_username"]) {
    echo
        '<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Galerie
          <span class="caret"></span></a>
          <ul class="dropdown-menu">';
      if(basename($_SERVER['PHP_SELF']) == "galerie_a_valider.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="galerie_a_valider.php">Galerie à valider</a></li>';
      if(basename($_SERVER['PHP_SELF']) == "galerie_a_visiter.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="galerie_a_visiter.php">Galerie à visiter</a></li>';
      if(basename($_SERVER['PHP_SELF']) == "galerie_360.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="galerie_360.php">Galerie à 360°</a></li>';
  echo '</ul>
    </li>';
  }
  else {
    echo
        '<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Galerie
          <span class="caret"></span></a>
          <ul class="dropdown-menu">';
    if(basename($_SERVER['PHP_SELF']) == "galerie_a_visiter.php")  {
        echo '<li class="active">';
    } else {
        echo '<li>';
    }
    echo '<a href="galerie_a_visiter.php">Galerie à visiter</a></li>';
    if(basename($_SERVER['PHP_SELF']) == "galerie_360.php")  {
        echo '<li class="active">';
    } else {
        echo '<li>';
    }
    echo '<a href="galerie_360.php">Galerie à 360°</a></li>';
    echo '</ul>
      </li>';
  }
  if($_COOKIE["the_username"]) {
    echo
          '<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Textes
            <span class="caret"></span></a>
            <ul class="dropdown-menu">';
      if(basename($_SERVER['PHP_SELF']) == "textes_a_valider.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="textes_a_valider.php">Textes à valider</a></li>';
      if(basename($_SERVER['PHP_SELF']) == "textes_a_lire.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="textes_a_lire.php">Textes à lire</a></li>';
  echo '</ul>
    </li>';
  } else {
    if(basename($_SERVER['PHP_SELF']) == "textes_a_lire.php")  {
        echo '<li class="active">';
    } else {
        echo '<li>';
    }
    echo '<a href="textes_a_lire.php">Textes à lire</a></li>';
  }
    if($_COOKIE["the_username"]) {
    echo
          '<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Vidéos
            <span class="caret"></span></a>
            <ul class="dropdown-menu">';
            
      if(basename($_SERVER['PHP_SELF']) == "videos_a_valider.php")  {
        echo '<li class="active">';
      } else {
        echo '<li>';
      }
      echo '<a href="videos_a_valider.php">Videos à valider</a></li>';
      if(basename($_SERVER['PHP_SELF']) == "videos_a_visualiser.php")  {
        echo '<li class="active">';
      } else {
        echo '<li>';
      }
      echo '<a href="videos_a_visualiser.php">Videos à lire</a></li>';
    echo '</ul>
        </li>';
    } else {
      if(basename($_SERVER['PHP_SELF']) == "videos_a_visualiser.php.php")  {
        echo '<li class="active">';
      } else {
        echo '<li>';
      }
      echo '<a href="videos_a_visualiser.php">Videos à lire</a></li>';
    }
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
       echo
          '<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Téléversement
            <span class="caret"></span></a>
            <ul class="dropdown-menu">';
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
          if(basename($_SERVER['PHP_SELF']) == "upload_video.php")  {
              echo '<li class="active">';
          } else {
              echo '<li>';
          }
          echo '<a href="upload_video.php">Téléversement de videos</a></li>';

      echo "</ul></li>";

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
