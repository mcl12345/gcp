<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation Personnalité : </h3>";

// Changement de la validité à 1

if (isset($_POST["id_personnalite"])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // Va chercher la personnalité :
  $stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite WHERE id = ?");
  $stmt->execute(array($_POST["id_personnalite"]));
  while ($row = $stmt->fetch()) {
        echo "<strong>nom : " . $row["nom"] . " a été validé.</strong> <br />";
        echo "fonction : " . $row["fonction"] . "<br />";
        echo "date_de_naissance : " . $row["date_naissance"] . "<br />";
        echo "date_de_deces : " . $row["date_deces"] . "<br />";
        echo "conjoint : " . $row["conjoint"] . "<br />";
        echo "type_gisant : " . $row["type_gisant"] . "<br />";
        echo "date_depot_gisant : " . $row["date_depot_gisant"];
  }

  // Change la validité à 1
  $stmt = $pdo->prepare("UPDATE patrimoine_basilique_personnalite SET valide = 1 WHERE id = ?");
  $stmt->execute(array($_POST["id_personnalite"]));

  // Memorise l' utilisateur qui a validé les medias.
  $stmt = $pdo->prepare("INSERT INTO historique_validation_personnalite (id_user, id_personnalite) VALUES (:id_user, :id_personnalite) ");
  $stmt->bindParam(':id_user', $_SESSION["the_id"]);
  $stmt->bindParam(':id_personnalite', $_POST["id_personnalite"]);
  $stmt->execute();
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
