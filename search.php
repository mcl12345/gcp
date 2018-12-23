<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
            <br />";

$is_resultat = false;
$tab_mot = array();
if( isset($_GET["recherche"])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
	$stmt = $pdo->prepare("SELECT * FROM mot_texte WHERE mot = ?");
  $stmt->execute(array($_GET["recherche"]));
  while ($ligne = $stmt->fetch()) {
      $stmt_ = $pdo->prepare("SELECT * FROM mot_document_texte WHERE id_mot_texte = ?");
      $stmt_->execute(array($ligne["id"]));
      while ($ligne_ = $stmt_->fetch()) {
          $_stmt_ = $pdo->prepare("SELECT * FROM document_texte WHERE id = ?");
          $_stmt_->execute(array($ligne_["id_document_texte"]));
          while ($ligne__ = $_stmt_->fetch()) {
              if($ligne__["valide"] == 1) {
                  $is_resultat = true;
                  echo "<strong><a target='_blank' href='un_texte_a_lire.php?id=".$ligne__["id"]."'>Titre : " . $ligne__["titre"]."</a></strong><br />";
                  echo "<strong>Texte : </strong>" . substr($ligne__["texte"], 0, 250);
                  echo "<br /><br /><br />";
              }
          }
      }
  }

  // Récupère la liste de tous les mots-clé qui sont séparés par des virgules.
  //------------------------------------------------------------------------------
	$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
	$stmt = $pdo->prepare("SELECT * FROM motcle");
  $stmt->execute();
  $i = 0;
  while ($ligne = $stmt->fetch()) {
     	$tab_mot["mots_cle"][] = explode("," , $ligne["mots_cle"]);
     	$tab_mot["id_media"][$i] = $ligne["id_media"];
     	$tab_mot["type_media"][$i] = $ligne["type_media"];
     	$i++;
  }
  //------------------------------------------------------------------------------
}

// Va chercher le mot-clé qui est stocké dans un tableau et qui correspond à la requête :
foreach($tab_mot["mots_cle"] as $indice => $mot) {
	  $id_media = $tab_mot["id_media"][$indice];
	  $type_media = $tab_mot["type_media"][$indice];
	  $is_motcle = false;
	  for($i=0; $i<sizeof($mot); $i++) {
		    if(trim($mot[$i]) == $_GET["recherche"]) {
			      $is_motcle = true;
			      break;
		    }
	  }
    if($is_motcle && $type_media == 2) {
  		$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
  		$stmt = $pdo->prepare("SELECT * FROM image WHERE id = ?");
      $stmt->execute(array($id_media));
  		while ($row = $stmt->fetch()) {
  			if($row["valide"] == 1) {
              $is_resultat = true;
  	    		  echo "<strong>Titre : </strong>" . $row["titre"] . "<br />";
  	      		echo "<strong>Description : </strong>" . $row["description"] . "<br />";
  	      		if($row["imageURL"] != null) {
  	        		echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
  	      		}
              echo "<br /><br />";
        }
      }
  	} else if($is_motcle && $type_media == 3) {
  		$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
  		$stmt = $pdo->prepare("SELECT * FROM audio WHERE id = ?");
      	$stmt->execute(array($id_media));
      	while ($row = $stmt->fetch()) {
      		if($row["valide"] == 1) {
              $is_resultat = true;
  	    	    echo "<strong>Titre : </strong>" . $row["titre"] . "<br />";
  	          	echo "<strong>Description : </strong>" . $row["description"] . "<br />";
  	          	echo '<strong>Audio : </strong><br /><audio width="400" height="222" controls="controls">
  	                             <source src="'.$row["audioURL"].'" type="audio/ogg" />
  	                             <source src="'.$row["audioURL"].'" type="audio/mp3" />
  	                             <source src="'.$row["audioURL"].'" type="audio/wav" />
  	                             Vous n\'avez pas de navigateur moderne ou à jour, donc pas de balise audio HTML5 !</audio>';
  	         	echo "<br /><br />";
           	}
          }
  	} else if($is_motcle && $type_media == 4) {
  		$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
  		$stmt = $pdo->prepare("SELECT * FROM video WHERE id = ?");
      	$stmt->execute(array($id_media));
      	while ($row = $stmt->fetch()) {
      		if($row["valide"] == 1) {
            $is_resultat = true;
  	    		echo "<strong>Titre : </strong>" . $row["titre"] . "<br />";
  	        echo "<strong>Description : </strong>" . $row["description"] . "<br />";
  	        echo '<strong>Vidéo : </strong><br /><video width="400" height="222" controls="controls">
  	                             <source src="'.$row["videoURL"].'" type="video/webm" />
  	                             <source src="'.$row["videoURL"].'" type="video/mp4" />
  	                             <source src="'.$row["videoURL"].'" type="video/avi" />
  	                             Vous n\'avez pas de navigateur moderne ou à jour, donc pas de balise video HTML5 !</video>';
  	         	echo "<br /><br />";
  	        }
      	}
  	}
}
if(!$is_resultat) {
    echo "Aucun résultats pour la recherche " . $_GET["recherche"];
}

echo "</div>
      <div class='col-lg-4'>&nbsp;</div>
      </div>";

echo footer();

echo "</body></html>";

?>
