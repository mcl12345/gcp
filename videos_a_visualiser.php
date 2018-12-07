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
     $is_video = true;

      if($row["valide"] == 1) {
          $motscle = "";
          $motcle_empty = true;
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

    echo "</div></div></div>";

if(!$is_video) {
      echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
            <div class='container'>";
            echo "Il n'existe pas encore de vidéos";
            echo "</div></div></div><br /><br />";
}

echo footer();

echo '</body>
</html>';

?>
