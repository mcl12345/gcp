<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation Audio : </h3><br /><br />";

// Changement de la validité à 1

if (isset($_POST["id_audio"])) {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    // Va chercher l'élément :
    $stmt = $pdo->prepare("SELECT * FROM audio WHERE id = ?");
    $stmt->execute(array($_POST["id_audio"]));
    while ($row = $stmt->fetch()) {

      $motscle = "";
      $motcle_empty = true;
      echo "<strong>Titre : " . $row["titre"] . " a été validé</strong><br /><br />";
      echo "<strong>Description : </strong>" . $row["description"] . "<br />";
      echo 'Audio : <audio width="400" height="222" controls="controls">
      <source src="'.$row["audioURL"].'" type="audio/ogg" />
      <source src="'.$row["audioURL"].'" type="audio/wav" />
      <source src="'.$row["audioURL"].'" type="audio/mp3" />
        Vous n\'avez pas de navigateur moderne, donc pas de balise audio HTML5 !</audio>';

            // Affichage des mots-clé :
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

    // Change de la validité à 1
    $stmt = $pdo->prepare("UPDATE audio SET valide = 1 WHERE id = ?");
    $stmt->execute(array($_POST["id_audio"]));

    // Memorise l' utilisateur qui a validé les medias.
    $stmt = $pdo->prepare("INSERT INTO historique_validation_audio (id_user, id_audio) VALUES (:id_user, :id_audio) ");
    $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
    $stmt->bindParam(':id_audio', $_POST["id_audio"]);
    $stmt->execute();
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
