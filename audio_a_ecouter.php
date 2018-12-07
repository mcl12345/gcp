<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

$is_audio = false;

// connexion à la bdd
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM audio");
$stmt->execute();

  echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
            <div class='container'>";

   while ($row = $stmt->fetch()) {
     $is_audio = true;

      if($row["valide"] == 1) {
          $motscle = "";
          $motcle_empty = true;
          echo "<strong>Titre : </strong>" . $row["titre"] . "<br /><br />";
          echo "<strong>Description : </strong>" . $row["description"] . "<br />";
          echo '<strong>Audio : </strong><br /><audio width="400" height="222" controls="controls">
                             <source src="'.$row["audioURL"].'" type="audio/ogg" />
                             <source src="'.$row["audioURL"].'" type="audio/mp3" />
                             <source src="'.$row["audioURL"].'" type="audio/wav" />
                             Vous n\'avez pas de navigateur moderne ou à jour, donc pas de balise audio HTML5 !</audio>';
         echo "<br /><br />";

         // Va chercher les mots-clé :
         $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 3");
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

if(!$is_audio) {
      echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
            <div class='container'>";
            echo "Il n'existe pas encore d'audio";
            echo "</div></div></div><br /><br />";
}

echo footer();

echo '</body>
</html>';

?>
