<?php

echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="description" content="Plateforme sur la Basilique de Saint-Denis">
  <meta name="keywords" content="cathédrale, jésus, Christ, basilique, stalle, Vierge-Marie, vitraux, cercueil, vitrail, nef, choeur">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
      if(basename($_SERVER['PHP_SELF']) == "api.php")  {
          echo '<li class="active">';
      } else {
          echo '<li>';
      }
      echo '<a href="api.php">API</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
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
<div class="container"><img src="img/logo-basilique-st-denis-250.png"</div>
<div class="container">';

?>
