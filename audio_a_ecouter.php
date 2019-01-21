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

  echo "<br><br><br>";
  echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
            <div class='container'>";

while ($row = $stmt->fetch()) {

    if($row["valide"] == 1) {
          $is_audio = true;
          $motscle = "";
          $motcle_empty = true;
          if($_COOKIE["the_role"] == "administrateur") {
              echo "<form action='audio_a_ecouter.php' method='get'>";
              echo "Cocher pour supprimer : <input type='radio' name='id_audio' value='".$row["id"]."' /><br />";
          }
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

if(!$is_audio) {
    echo "Il n'existe pas encore de fichier audio";
}

if($_COOKIE["the_role"] == "administrateur" && $is_audio) {
    echo "<input type='submit' value='Supprimer' />
    </form>";
}
if(isset($_GET["id_audio"])) {
    // Suppression du fichier audio
    $stmt_ = $pdo->prepare("SELECT * FROM audio WHERE id = ?");
    $stmt_->execute(array($_GET["id_audio"]));
    while($row = $stmt_->fetch()) {
        $position = stripos($row["audioURL"], "upload_audio/");
        $delete_audio = substr($row["audioURL"], $position, strlen($row["audioURL"])-$position);
        unlink($delete_audio);
    }

    // Suppression du fichier audio de la bdd
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt_ = $pdo->prepare("DELETE FROM audio WHERE id = ?");
    $stmt_->execute(array($_GET["id_audio"]));

    // Suppression des motscle
    $_stmt_ = $pdo->prepare("DELETE FROM motcle WHERE id_media = ? AND type_media = 3");
    $_stmt_->execute(array($_GET["id_audio"]));
}

echo "</div></div></div>";

echo footer();

echo '</body>
</html>';

?>
