<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation Image : </h3><br /><br />";

// Changement de la validité à 1

if (isset($_POST["id_image"])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // Va chercher la personnalité :
  $stmt = $pdo->prepare("SELECT * FROM image WHERE id = ?");
  $stmt->execute(array($_POST["id_image"]));
  while ($row = $stmt->fetch()) {
    echo "<strong>Titre : </strong>" . $row["titre"] . " a été validé</strong><br /><br />";
    echo "<strong>Description : </strong>" . $row["description"] . "<br />";
    echo "Image : <a href='". $row["imageURL"] ."'><img width='250px' height='250px' src='" . $row["imageURL"] . "' /></a><br />";

    $motscle = "";
    $motcle_empty = true;
    $type_media = 2;
    $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = " . $type_media);
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

  // Change la validité à 1
  $stmt = $pdo->prepare("UPDATE image SET valide = 1 WHERE id = ?");
  $stmt->execute(array($_POST["id_image"]));

  // Memorise l' utilisateur qui a validé les medias.
  $stmt = $pdo->prepare("INSERT INTO historique_validation_image (id_user, id_image) VALUES (:id_user, :id_image) ");
  $stmt->bindParam(':id_user', $_SESSION["the_id"]);
  $stmt->bindParam(':id_image', $_POST["id_image"]);
  $stmt->execute();
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
