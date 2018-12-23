<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');
include('indexation12.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation d'un texte : </h3><br /><br />";

// Changement de la validité à 1

if (isset($_POST["id_texte"])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // Va chercher le texte :
  $stmt = $pdo->prepare("SELECT * FROM document_texte WHERE id = ?");
  $stmt->execute(array($_POST["id_texte"]));
  while ($row = $stmt->fetch()) {
      echo "<strong><span style='color:red;'>Titre : '" . $row["titre"] . "' a été validé</span></strong><br /><br />";
      echo "Texte : " . $row["texte"] . "<br />";
      echo "<br /><br /><br />";
      indexer($row["titre"], $row["texte"]);
  }

  // Change la validité à 1
  $stmt = $pdo->prepare("UPDATE document_texte SET valide = 1 WHERE id = ?");
  $stmt->execute(array($_POST["id_texte"]));

  // Memorise l' utilisateur qui a validé les medias.
  $stmt = $pdo->prepare("INSERT INTO historique_validation_texte (id_user, id_texte) VALUES (:id_user, :id_texte) ");
  $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
  $stmt->bindParam(':id_texte', $_POST["id_texte"]);
  $stmt->execute();
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
