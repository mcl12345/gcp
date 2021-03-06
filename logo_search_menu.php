<?php

session_start();

function print_LOGO_FORMSEARCH_MENU() {
echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Plateforme sur la Basilique de Saint-Denis</title>
  <meta charset="utf-8">
  <meta name="description" content="Plateforme sur la Basilique de Saint-Denis">
  <meta name="keywords" content="cathédrale, basilique, stalle, Saint-Denis, vitraux, cercueil, vitrail, nef, choeur">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/style_lire.css"> <!-- pour personnalite-->
  <link rel="stylesheet" href="css/footer.css"><!-- pour le footer -->';
  if(basename($_SERVER['PHP_SELF']) == "faq.php")  {
      echo '<link rel="stylesheet" href="css/reset.css"><!-- pour la FAQ -->
      <link rel="stylesheet" href="css/style.css"><!-- pour la FAQ -->
      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css"><!-- pour la FAQ -->
      <script src="js/jquery-2.1.1.js"></script><!-- pour la FAQ -->
      <script src="js/jquery.mobile.custom.min.js"></script><!-- pour la FAQ -->
      <script src="js/main.js"></script><!-- pour la FAQ -->
      <script src="js/modernizr.js"></script><!-- pour la FAQ -->';
  }
  if(basename($_SERVER['PHP_SELF']) == "contact_nous.php")  {
	  echo "
	  <!--<link href='//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
	  <script src='//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>-->
	  <script src='//code.jquery.com/jquery-1.11.1.min.js'></script>";
  }

echo '
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="css/bootstrap5.css" rel="stylesheet">
<script src="js/bootstrap5.js"></script>
<link rel="stylesheet" href="css/index.css">
<style type="text/css">

/* ============ desktop view ============ */
@media all and (min-width: 992px) {

	.dropdown-menu li{
		position: relative;
	}
	.dropdown-menu .submenu{ 
		display: none;
		position: absolute;
		left:100%; top:-7px;
	}
	.dropdown-menu .submenu-left{ 
		right:100%; left:auto;
	}

	.dropdown-menu > li:hover{ background-color: #f1f1f1 }
	.dropdown-menu > li:hover > .submenu{
		display: block;
	}
}	
/* ============ desktop view .end// ============ */

/* ============ small devices ============ */
@media (max-width: 991px) {

	.dropdown-menu li{
		position: relative;
	}

	.dropdown-menu .submenu-left{ 
		right:100%; left:auto;
	}

	.dropdown-menu > li:hover{ background-color: #f1f1f1 }
	.dropdown-menu > li:hover > .submenu{
		display: block;
	}

.dropdown-menu .dropdown-menu{
		margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
}

}	
/* ============ small devices .end// ============ */

</style>


<script type="text/javascript">
	window.addEventListener("resize", function() {
		"use strict"; window.location.reload(); 
	});

	document.addEventListener("DOMContentLoaded", function(){
        
		// make it as accordion for smaller screens
		if (window.innerWidth < 992) {

			// close all inner dropdowns when parent is closed
			document.querySelectorAll(".navbar .dropdown").forEach(function(everydropdown){
				everydropdown.addEventListener("hidden.bs.dropdown", function () {
					// after dropdown is hidden, then find all submenus
					  this.querySelectorAll(".submenu").forEach(function(everysubmenu){
					  	// hide every submenu as well
					  	everysubmenu.style.display = "none";
					  });
				})
			});
			
			document.querySelectorAll(".dropdown-menu a").forEach(function(element){
				element.addEventListener("click", function (e) {
		
				  	let nextEl = this.nextElementSibling;
				  	if(nextEl && nextEl.classList.contains("submenu")) {	
				  		// prevent opening link if link needs to open dropdown
				  		e.preventDefault();

				  		if(nextEl.style.display == "block"){
				  			nextEl.style.display = "none";
				  		} else {
				  			nextEl.style.display = "block";
				  		}

				  	}
				});
			})
		}
		// end if innerWidth

	}); 
	// DOMContentLoaded  end
</script>

</head>
<body>
<div id="mybody">
<div class="container">

<!-- ============= COMPONENT ============== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container-fluid">
 	 <a class="navbar-brand titre" href="https://basiliquesaintdenis.ovh/basilique-saint-denis/">&nbsp;&nbsp;&nbsp;Site sur la Basilique de Saint-Denis</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="main_nav">
	

	<ul class="navbar-nav">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Menu</a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="#">Personnalités »</a>
          <ul class="submenu dropdown-menu">';
           
           if($_SESSION["the_username"]) {
             echo '<li><a class="dropdown-item" href="upload_personnalite.php">Upload de personnalité</a></li>
                  <li><a class="dropdown-item" href="personnalite_a_valider.php">Personnalité à valider</a></li>
                  <li><a class="dropdown-item" href="personnalite_a_modifier.php">Personnalité à modifier</a></li>
                  <li><a class="dropdown-item" href="personnalites.php?page=1">Personnalités</a></li>
                  <li><a class="dropdown-item" href="upload_roi.php">Ajouter un roi</a></li>
                  <li><a class="dropdown-item" href="select_roi_reseaux_sociaux.php">Ajouter à un roi des réseaux sociaux</a></li>
                  <li><a class="dropdown-item" href="select_roi_representation.php">Ajouter à un roi des représentations</a></li>
                  <li><a class="dropdown-item" href="rois.php">Rois</a></li>';
           } else { 
             echo  '<li><a class="dropdown-item" href="personnalites.php?page=1">Personnalités</a></li>
                    <li><a class="dropdown-item" href="rois.php">Rois</a></li>';
           } 
           echo '</ul></li>
			      <li><a class="dropdown-item" href="#">Chapelles »</a>
			  	  <ul class="submenu dropdown-menu">';
           
          if($_SESSION["the_username"]) {      
            echo '<li><a class="dropdown-item" href="upload_chapelle.php">Upload de chapelles</a></li>
                  <li><a class="dropdown-item" href="chapelle_a_valider.php">Chapelles à valider</a></li>
                  <li><a class="dropdown-item" href="chapelles.php">Chapelles</a></li>';
          } else { 
            echo  '<li><a class="dropdown-item" href="chapelles.php">Chapelles à découvrir</a></li>
           ';
          } 
          echo '</ul>
			  </li>
			  <li><a class="dropdown-item" href="#">Textes »</a>
			  	 <ul class="submenu dropdown-menu">
           ';
           
          if($_SESSION["the_username"]) {      
            echo '<li><a class="dropdown-item" href="textes_a_valider.php">Textes à valider</a></li>
                  <li><a class="dropdown-item" href="textes_a_lire.php">Textes à lire</a></li>';
          } else { 
            echo  '<li><a class="dropdown-item" href="textes_a_lire.php">Textes à lire</a></li>';
          } 
          echo '
				 </ul>
			  </li>
			  <li><a class="dropdown-item" href="#">Galerie »</a>
          <ul class="submenu dropdown-menu">
          ';
           
          if($_SESSION["the_username"]) {      
            echo '<li><a class="dropdown-item" href="galerie_a_visiter.php">Galerie à visiter</a></li>
            <li><a class="dropdown-item" href="galerie_360.php">Galerie à 360°</a></li>
            <li><a class="dropdown-item" href="image_a_valider.php">Images à valider</a></li>';
          } else { 
            echo  '<li><a class="dropdown-item" href="galerie_a_visiter.php">Galerie à visiter</a></li>
            <li><a class="dropdown-item" href="galerie_360.php">Galerie à 360°</a></li>';
          } 
          echo '
              
          </ul>
			  </li>
			  <li><a class="dropdown-item" href="#">Audios »</a>
          <ul class="submenu dropdown-menu">
          ';
          
            if($_SESSION["the_username"]) {      
              echo  '<li><a class="dropdown-item" href="audio_a_valider.php">Audio à valider</a></li>
                      <li><a class="dropdown-item" href="audio_a_ecouter.php">Audio à écouter</a></li>';
            } else { 
              echo  '<li><a class="dropdown-item" href="audio_a_ecouter.php">Audio à écouter</a></li>';
            } 
            echo '
          </ul>
        </li>
			  <li><a class="dropdown-item" href="#">Vidéos »</a>
        <ul class="submenu dropdown-menu">
        ';
        
       if($_SESSION["the_username"]) {      
         echo '<li><a class="dropdown-item" href="videos_a_valider.php">Videos à valider</a></li>
         <li><a class="dropdown-item" href="videos_a_visualiser.php">Videos à lire</a></li>';
       } else { 
         echo  '<li><a class="dropdown-item" href="videos_a_visualiser.php">Videos à lire</a></li>';
       } 
       echo '
      </ul></li>'; 
    echo '
    <li><a class="dropdown-item" href="faq.php">FAQ</a></li>
		    </ul>
		</li>
	</ul>

  <form class="navbar-form navbar-left" action="search.php" method="get">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Recherche" id="recherche" name="recherche" />
      <div class="input-group-btn">
        <button class="btn btn-light" type="submit" style="height:34px;">
          <i class="glyphicon glyphicon-search"></i>
        </button>
      </div>
    </div>
  </form>

	<ul class="navbar-nav ms-auto">
		<li class="nav-item dropdown">
    ';
    if($_SESSION["the_username"]) {      
      echo '<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Téléversement</a>
		    <ul class="dropdown-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="upload_texte.php">Téléversement de texte</a></li>
          <li><a class="dropdown-item" href="upload_image.php">Téléversement d\'image</a></li>
          <li><a class="dropdown-item" href="upload_audio.php">Téléversement d\'audio</a></li>
          <li><a class="dropdown-item" href="upload_video.php">Téléversement de videos</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
			<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Paramètres </a>
		    <ul class="dropdown-menu dropdown-menu-right">      
              <li><a class="dropdown-item" href="profil.php"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
              <li><a class="dropdown-item" href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Déconnexion</a></li>';
              if($_SESSION["administrateur"]) {      
                echo '<li><a class="dropdown-item" href="contact_message.php">Contacts messages</a></li>';
              }
        echo '
          </ul>
        </li>';
      } else {
        echo '<li class="nav-item"><a class="nav-link" href="register.php"><span class="glyphicon glyphicon-user"></span> Enregistrement</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>';
      }
		    echo '</ul>
		</li>
	</ul>

  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->
</nav>

<!-- ============= COMPONENT END// ============== -->
</div><!-- container //  -->
<div class="container-set-logo">
  <img class="container-set-logo-image" src="img/logo-basilique-st-denis-250.png" />
</div>';
}

?>
