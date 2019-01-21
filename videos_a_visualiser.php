<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

$is_video = false;

// connexion à la bdd
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM video");
$stmt->execute();

  echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
            <div class='container'>";

   while ($row = $stmt->fetch()) {
      if($row["valide"] == 1) {
          $is_video = true;
          $motscle = "";
          $motcle_empty = true;
          if($_COOKIE["the_role"] == "administrateur") {
              echo "<form action='videos_a_visualiser.php' method='get'>";
              echo "Cocher pour supprimer : <input type='radio' name='id_video' value='".$row["id"]."' /><br />";
          }
          echo "<strong>Titre : </strong>" . $row["titre"] . "<br /><br />";
          echo "<strong>Description : </strong>" . $row["description"] . "<br />";
          echo '<strong>Vidéo : </strong><br /><video width="400" height="222" controls="controls">
                             <source src="'.$row["videoURL"].'" type="video/webm" />
                             <source src="'.$row["videoURL"].'" type="video/mp4" />
                             <source src="'.$row["videoURL"].'" type="video/avi" />
                             Vous n\'avez pas de navigateur moderne ou à jour, donc pas de balise video HTML5 !</video>';
         echo "<br /><br />";

         // Va chercher les mots-clé :
         $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 4");
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



if(!$is_video) {
            echo "Il n'existe pas encore de vidéos";
}

if($_COOKIE["the_role"] == "administrateur" && $is_video) {
    echo "<input type='submit' value='Supprimer' />
    </form>";
}

// Suppression
if(isset($_GET["id_video"])) {
    // Suppression du fichier video
    $stmt_ = $pdo->prepare("SELECT * FROM video WHERE id = ?");
    $stmt_->execute(array($_GET["id_video"]));
    while($row = $stmt_->fetch()) {
        $position = stripos($row["videoURL"], "upload_videos/");
        $delete_video = substr($row["videoURL"], $position, strlen($row["videoURL"])-$position);
        unlink($delete_video);
    }

    // Suppression de la table
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt_ = $pdo->prepare("DELETE FROM video WHERE id = ?");
    $stmt_->execute(array($_GET["id_video"]));

    // Suppression des mots-cle
    $_stmt_ = $pdo->prepare("DELETE FROM motcle WHERE id_media = ? AND type_media = 4");
    $_stmt_->execute(array($_GET["id_video"]));
}

echo "</div></div></div>";

echo footer();

echo '</body>
</html>';

?>
