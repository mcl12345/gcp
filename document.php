<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-6'>";

function formulaire_selection($db_host, $db_name, $db_user, $db_password) {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM document");
    $stmt->execute();

    echo '<h3>Séletionner un document public existant : </h3><form action="document_ajout.php" method="get">';
    while ($row = $stmt->fetch()) {
        echo "<input type='radio' name='id_document' value='".$row["id"]."' />";
        echo "<span>".$row["titre"]."</span><br />";
    }
    echo "<input type='submit' value='Envoyer' />
    </form>";

    echo "<br /><br /><br /><br />";

    echo "<form action='document.php' method='post'>
    			<label><strong>Créer un document : </strong></label><br />
    			<label><strong>Titre : </strong></label><input type='text' name='titre' id='titre' required /><br />
    			Média à selectionner : <select name='media'>
    				<option value='texte'>texte</option>
    				<option value='image'>image</option>
    				<option value='audio'>audio</option>
    				<option value='video'>video</option>
    			</select><br />
    			<input type='submit' value='Sélectionner' />
    		</form>";
}

if( isset($_POST["media"]) ) {
  $id_document = 0;
	if(!isset($_POST['id_document'])) {
      $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    	$stmt = $pdo->prepare("INSERT INTO document (titre) VALUES (:titre)");
      $stmt->bindParam(':titre', $_POST["titre"]);
      $stmt->execute();
      $id_document = $pdo->lastInsertId();
  } else if(isset($_POST['id_document'])) {
      $id_document = $_POST['id_document'];
  }

  // ----------------------------------------------------------------- début TEXTE
	if($_POST["media"] == "texte") {

		$is_non_valide = true;
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
		$stmt = $pdo->prepare("SELECT * FROM texte");
		$stmt->execute();

		echo '<form action="document_ajout.php?id_document='.$id_document.'" method="post">';
		while ($row = $stmt->fetch()) {
		    if($row["valide"] == 1) {
		        $is_non_valide = false;
		        $motscle = "";
		        $motcle_empty = true;
		        $type_media = 1;
		        echo "<input type='radio' name='id_texte' value='".$row["id"]."' />";
		        echo "Titre : " . $row["titre"] . "<br />";
		        echo "Texte : " . $row["texte"] . "<br />";

		        $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media=" . $type_media);
		        $stmt_->execute(array($row["id"]));
		        while ($ligne = $stmt_->fetch()) {
		            $motcle_empty = false;
		            $motscle .= " " . $ligne["mots_cle"] ;
		        }
		        if(!$motcle_empty) {
		            echo "<strong>Les mots-clé : </strong>" . $motscle;
		        }

		        echo "<br /><br /><br />";
		    }
		}
		if(!$is_non_valide) {
		    echo "<input value='Valider' type='submit' />";
		    echo "</form><br />";
		} else {
		    echo "La liste est vide !";
		}
	}
	// ----------------------------------------------------------------- fin TEXTE

	// ----------------------------------------------------------------- début IMAGE
	else if($_POST["media"] == "image") {
		$is_non_valide = true;
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
		$stmt = $pdo->prepare("SELECT * FROM image");
		$stmt->execute();

		echo '<form action="document_ajout.php?id_document='.$id_document.'"  method="post">';
		while ($row = $stmt->fetch()) {
		    if($row["valide"] == 1) {
		        $is_non_valide = false;
		        $motscle = "";
		        $motcle_empty = true;
            $type_media = 2;
		        echo "<input type='radio' name='id_image' value='".$row["id"]."' />";
            echo "Titre : " . $row["titre"] . "<br />";
		        echo "Description : " . $row["description"] . "<br />";
		        echo "image : <a target='_blank' href='".$row["imageURL"]."'><img width='250px' height='250px' src='".$row["imageURL"] . "'/></a><br />";

		        $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = ". $type_media);
		        $stmt_->execute(array($row["id"]));
		        while ($ligne = $stmt_->fetch()) {
		            $motcle_empty = false;
		            $motscle .= " " . $ligne["mots_cle"];
		        }
		        if(!$motcle_empty) {
		            echo "<strong>Les mots-clé : </strong>" . $motscle;
		        }

		        echo "<br /><br /><br />";
		    }
		}
		if(!$is_non_valide) {
		  echo "<input value='Valider' type='submit' />";
		  echo "</form><br />";
		} else {
		  echo "La liste est vide !";
		}
	}
	// ----------------------------------------------------------------- fin IMAGE

	// ----------------------------------------------------------------- début AUDIO
	else if($_POST["media"] == "audio") {

		echo "<h3>Sélection de son : </h3>";

		$is_non_valide = true;
		$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
		$stmt = $pdo->prepare("SELECT * FROM audio");
		$stmt->execute();

		echo '<form action="document_ajout.php?id_document='.$id_document.'" method="post">';
		while ($row = $stmt->fetch()) {
		    if($row["valide"] == 1) {
		        $is_non_valide = false;
		        $motscle = "";
		        $motcle_empty = true;
		        echo "<input type='radio' name='id_audio' value='".$row["id"]."' />";
            echo "Titre : " . $row["titre"] . "<br />";
		        echo "Description : " . $row["description"] . "<br />";

		        echo '<br />Audio : <audio width="400" height="222" controls="controls">
		        <source src="'.$row["audioURL"].'" type="audio/ogg" />
		        <source src="'.$row["audioURL"].'" type="audio/wav" />
		        <source src="'.$row["audioURL"].'" type="audio/mp3" />
		          Vous n\'avez pas de navigateur moderne, donc pas de balise audio HTML5 !</audio><br />';

		        $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 3");
		        $stmt_->execute(array($row["id"]));
		        while ($ligne = $stmt_->fetch()) {
		            $motcle_empty = false;
		            $motscle .= " " . $ligne["mots_cle"];
		        }
		        if(!$motcle_empty) {
		            echo "<br /><br /><strong>Les mots-clé : </strong>" . $motscle;
		        }

		        echo "<br /><br /><br />";
		    }
		}
		if(!$is_non_valide) {
  		  echo "<input value='Valider' type='submit' />";
  		  echo "</form><br />";
		} else {
		    echo "La liste est vide !";
		}
		echo '</div></div></div>';

		echo '<br /><br />';
	}
	// ----------------------------------------------------------------- fin AUDIO

	// ----------------------------------------------------------------- début VIDEO
	else if($_POST["media"] == "video") {
      echo "<h3>Validation Vidéo : </h3>";

      $is_non_valide = true;
      $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
      $stmt = $pdo->prepare("SELECT * FROM video");
      $stmt->execute();

      echo '<form action="document_ajout.php?id_document='.$id_document.'" method="post">';
      while ($row = $stmt->fetch()) {
          if($row["valide"] == 1) {
              $is_non_valide = false;
              $motscle = "";
              $motcle_empty = true;
              $type_media = 4;
              echo "<input type='radio' name='id_video' value='".$row["id"]."' />";
              echo "Titre : " . $row["titre"] . "<br />";
              echo "Description : " . $row["description"] . "<br />";
              // voir ogg
              echo 'Vidéo : <video width="400" height="222" controls="controls">
              <source src="'.$row["videoURL"].'" type="video/webm" />
                Vous n\'avez pas de navigateur moderne, donc pas de balise video HTML5 !</video>';

              $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = ". $type_media);
              $stmt_->execute(array($row["id"]));
              while ($ligne = $stmt_->fetch()) {
                  $motcle_empty = false;
                  $motscle .= " " . $ligne["mots_cle"];
              }
              if(!$motcle_empty) {
                  echo "<strong>Les mots-clé : </strong>" . $motscle;
              }

              echo "<br /><br /><br />";
          }
      }
      if(!$is_non_valide) {
        echo "<input value='Valider' type='submit' />";
        echo "</form><br />";
      } else {
        echo "La liste est vide !";
      }
	}
} else {
    formulaire_selection($db_host, $db_name, $db_user, $db_password);
}
echo "</div></div></div>";

echo footer();

echo '</body></html>'

?>
