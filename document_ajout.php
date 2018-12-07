<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM document WHERE id = ?");
$stmt->execute(array($_GET["id_document"]));
while ($row = $stmt->fetch()) {
    echo "<h3>".$row["titre"]." : </h3><br /><br />";
}

// ---------------------------- début TEXTE
if (isset($_POST["id_texte"])) {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    // Va chercher l'élément :
    $stmt = $pdo->prepare("SELECT * FROM texte WHERE id = ?");
    $stmt->execute(array($_POST["id_texte"]));
    while ($row = $stmt->fetch()) {

        $motscle = "";
        $motcle_empty = true;

        $type_media = 1;
        echo "<strong>Description : " . $row["titre"] . " a été selectionné</strong><br /><br />";
        echo "Texte : " . $row["texte"] . "<br />";

        // Affichage des mots-clé :
        $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = ".$type_media);
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

    // Crée le fichier multimédia :
    $stmt = $pdo->prepare("INSERT INTO media_document (id_media, type_media, id_document) VALUES (:id_media, :type_media, :id_document)");
    $stmt->bindParam(':id_media', $_POST["id_texte"]);
    $stmt->bindParam(':type_media', $type_media);
    $stmt->bindParam(':id_document', $_GET["id_document"]);
    $stmt->execute();
}
// ---------------------------- fin TEXTE

// ---------------------------- début IMAGE
if (isset($_POST["id_image"])) {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    // Va chercher l'élément :
    $stmt = $pdo->prepare("SELECT * FROM image WHERE id = ?");
    $stmt->execute(array($_POST["id_image"]));
    while ($row = $stmt->fetch()) {
        $motscle = "";
        $motcle_empty = true;

        $type_media = 2;
        echo "<strong>Titre : " . $row["titre"] . " a été selectionné</strong><br /><br />";
        echo "<strong>Description : </strong>" . $row["description"] . " <br />";
        echo "image : <a target='_blank' href='".$row["imageURL"]."'><img width='250px' height='250px' src='".$row["imageURL"] . "'/></a>
              <br />";

        // Affichage des mots-clé :
        $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = ".$type_media);
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

    // Crée le fichier multimédia :
    $stmt = $pdo->prepare("INSERT INTO media_document (id_media, type_media, id_document) VALUES (:id_media, :type_media, :id_document)");
    $stmt->bindParam(':id_media', $_POST["id_image"]);
    $stmt->bindParam(':type_media', $type_media);
    $stmt->bindParam(':id_document', $_GET["id_document"]);
    $stmt->execute();
}
// ---------------------------- fin IMAGE

// ---------------------------- début AUDIO
if (isset($_POST["id_audio"])) {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    // Va chercher l'élément :
    $stmt = $pdo->prepare("SELECT * FROM audio WHERE id = ?");
    $stmt->execute(array($_POST["id_audio"]));
    while ($row = $stmt->fetch()) {

      $motscle = "";
      $motcle_empty = true;

      $type_media = 3;
      echo "<strong>Titre :" . $row["titre"] . " a été selectionné </strong><br />";
      echo "<strong>Description : </strong>" . $row["description"] . "<br />";
      echo 'Audio : <audio width="400" height="222" controls="controls">
      <source src="'.$row["audioURL"].'" type="audio/ogg" />
      <source src="'.$row["audioURL"].'" type="audio/wav" />
      <source src="'.$row["audioURL"].'" type="audio/mp3" />
        Vous n\'avez pas de navigateur moderne, donc pas de balise audio HTML5 !</audio>';

      // Affichage des mots-clé :
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

    // Crée le fichier multimédia :
    $stmt = $pdo->prepare("INSERT INTO media_document (id_media, type_media, id_document) VALUES (:id_media, :type_media, :id_document)");
    $stmt->bindParam(':id_media', $_POST["id_audio"]);
    $stmt->bindParam(':type_media', $type_media);
    $stmt->bindParam(':id_document', $_GET["id_document"]);
    $stmt->execute();
}
// ---------------------------- fin AUDIO

// ---------------------------- début VIDEO
if (isset($_POST["id_video"])) {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    // Va chercher l'élément :
    $stmt = $pdo->prepare("SELECT * FROM video WHERE id = ?");
    $stmt->execute(array($_POST["id_video"]));
    while ($row = $stmt->fetch()) {

      $motscle = "";
      $motcle_empty = true;

      $type_media = 4;
      echo "<strong>Titre :" . $row["titre"] . " a été selectionné </strong><br />";
      echo "<strong>Description : </strong>" . $row["description"] . "<br />";
      echo 'Video : <video width="400" height="222" controls="controls">
      <source src="'.$row["videoURL"].'" type="video/webm" />
      <source src="'.$row["videoURL"].'" type="video/avi" />
      <source src="'.$row["videoURL"].'" type="video/mp4" />
        Vous n\'avez pas de navigateur moderne, donc pas de balise video HTML5 !</video>';

      // Affichage des mots-clé :
      $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = " . $type_media);
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

    // Crée le fichier multimédia :
    $stmt = $pdo->prepare("INSERT INTO media_document (id_media, type_media, id_document) VALUES (:id_media, :type_media, :id_document)");
    $stmt->bindParam(':id_media', $_POST["id_video"]);
    $stmt->bindParam(':type_media', $type_media);
    $stmt->bindParam(':id_document', $_GET["id_document"]);
    $stmt->execute();
}
// Affichage des documents
else {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    // Va chercher l'élément :
    $stmt = $pdo->prepare("SELECT * FROM document WHERE id=".$_GET["id_document"]);
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $stmt_ = $pdo->prepare("SELECT * FROM media_document WHERE id_document = " . $row["id"]);
        $stmt_->execute();
        // Tous les médias :
        while($ligne = $stmt_->fetch()) {
            if($ligne["type_media"] == 1) {
                $_stmt_ = $pdo->prepare("SELECT * FROM texte WHERE id = " . $ligne["id_media"]);
                $_stmt_->execute();
                while($ligne_ = $_stmt_->fetch()) {
                    echo "<br /><br />";
                    echo "<strong>Titre : </strong>" , $ligne_["titre"];
                    echo "<br /><strong>Texte : </strong>" , $ligne_["texte"];
                }
            }
            if($ligne["type_media"] == 2) {
                $_stmt_ = $pdo->prepare("SELECT * FROM image WHERE id = " . $ligne["id_media"]);
                $_stmt_->execute();
    		        $motscle = "";
    		        $motcle_empty = true;
                while($ligne_ = $_stmt_->fetch()) {
                    echo "<br /><br />";
                    echo "<strong>Titre : </strong>" , $ligne_["titre"], "<br />";
                    echo "<strong>Description : </strong>" , $ligne_["description"] , "<br />";
                    echo "<strong>Image : </strong><a target='_blank' href='".$ligne_["imageURL"]."'><img width='250px' height='250px' src='".$ligne_["imageURL"] . "'/></a>
                          <br />";

                    $__stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media=" . $ligne["type_media"]);
                    $__stmt_->execute(array($ligne["id_media"]));
                    while ($ligne_mot = $__stmt_->fetch()) {
                        $motcle_empty = false;
                        $motscle .= " " . $ligne_mot["mots_cle"] ;
                    }
                    if(!$motcle_empty) {
                        echo "<br /><strong>Les mots-clé : </strong>" . $motscle;
                    }

                    echo "<br /><br /><br />";
                }
            }
            if($ligne["type_media"] == 3) {
                $_stmt_ = $pdo->prepare("SELECT * FROM audio WHERE id = " . $ligne["id_media"]);
                $_stmt_->execute();
    		        $motscle = "";
    		        $motcle_empty = true;
                while($ligne_ = $_stmt_->fetch()) {
                    echo "<br /><br />";
                    echo "<strong>Titre : </strong>" , $ligne_["titre"], "<br />";
                    echo "<strong>Description : </strong>" , $ligne_["description"] , "<br />";
                    echo '<strong>Audio : </strong><audio width="400" height="222" controls="controls">
                    <source src="'.$ligne_["audioURL"].'" type="audio/ogg" />
                    <source src="'.$ligne_["audioURL"].'" type="audio/wav" />
                    <source src="'.$ligne_["audioURL"].'" type="audio/mp3" />
                      Vous n\'avez pas de navigateur moderne, donc pas de balise audio HTML5 !</audio>';

                      $__stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media=" . $ligne["type_media"]);
                      $__stmt_->execute(array($ligne["id_media"]));
                      while ($ligne_mot = $__stmt_->fetch()) {
                          $motcle_empty = false;
                          $motscle .= " " . $ligne_mot["mots_cle"] ;
                      }
                      if(!$motcle_empty) {
                          echo "<br /><strong>Les mots-clé : </strong>" . $motscle;
                      }

                    echo "<br /><br /><br />";
                }
            }
            if($ligne["type_media"] == 4) {
                $_stmt_ = $pdo->prepare("SELECT * FROM video WHERE id = " . $ligne["id_media"]);
                $_stmt_->execute();
    		        $motscle = "";
    		        $motcle_empty = true;
                while($ligne_ = $_stmt_->fetch()) {
                    echo "<br /><br />";
                    echo "<strong>Titre : </strong>" , $ligne_["titre"], "<br />";
                    echo "<strong>Description : </strong>" , $ligne_["description"], "<br />";
                    echo '<strong>Video : </strong><video width="400" height="222" controls="controls">
                    <source src="'.$ligne_["videoURL"].'" type="video/webm" />
                    <source src="'.$ligne_["videoURL"].'" type="video/avi" />
                    <source src="'.$ligne_["videoURL"].'" type="video/mp4" />
                      Vous n\'avez pas de navigateur moderne, donc pas de balise video HTML5 !</video>';

                      $__stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media=" . $ligne["type_media"]);
                      $__stmt_->execute(array($ligne["id_media"]));
                      while ($ligne_mot = $__stmt_->fetch()) {
                          $motcle_empty = false;
                          $motscle .= " " . $ligne_mot["mots_cle"] ;
                      }
                      if(!$motcle_empty) {
                          echo "<br /><strong>Les mots-clé : </strong>" . $motscle;
                      }

                    echo "<br /><br /><br />";
                }
            }
        }
    }
    echo "<br /><br /><br /><br />
        <form action='document.php' method='post'>
          <label><strong>Modifier un document : </strong></label><br />
          <input type='hidden' name='id_document' value='".$_GET['id_document']."' />
          Média à selectionner : <select name='media'>
            <option value='texte'>texte</option>
            <option value='image'>image</option>
            <option value='audio'>audio</option>
            <option value='video'>video</option>
          </select><br />
          <input type='submit' value='Sélectionner' />
        </form>";
}
// --------------------------------------- fin VIDEO

echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
