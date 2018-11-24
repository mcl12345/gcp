<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation : </h3>";

// Changement dans les éléments qui constituent la personnalité

if (isset($_GET["id_personnalite"])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // Va chercher la personnalité :
  $stmt = $pdo->prepare("SELECT * FROM personnalite WHERE id = ?");
  $stmt->execute(array($_GET["id_personnalite"]));
  while ($row = $stmt->fetch()) {
        echo "<form action='personnalite_modification.php' method='post' >";
        echo "<input type='hidden' name='id_personnalite' value='".$row["id"]."' />";
        echo "<label for='nom'>Nom : </label><input id='nom' name='nom'  value='" . $row["nom"] . "' /><br />";
        echo "<label for='fonction'>Fonction : </label><input id='fonction' name='fonction' value='" . $row["fonction"] . "' /><br />";
        echo "<label for='date_naissance'>Date de naissance : </label><input id='date_naissance' name='date_naissance' value='" . $row["date_naissance"] . "' /><br />";
        echo "<label for='date_deces'>Date de décès : </label><input id='date_deces' name='date_deces' value='" . $row["date_deces"] . "' /><br />";
        echo "<label for='conjoint'>Conjoint : </label><input id='conjoint' name='conjoint' value='" . $row["conjoint"] . "' /><br />";
        echo "<label for='type_gisant'>Type de gisant : </label><input id='type_gisant' name='type_gisant' value='" . $row["type_gisant"] . "' /><br />";
        echo "<label for='date_depot_gisant'>Date de dépôt de gisant : </label><input id='date_depot_gisant' name='date_depot_gisant' value='" . $row["date_depot_gisant"] . "' /><br />";
        echo "<input type='submit' value='Modifier' />";
        echo "</form>";
  }
} else if ( isset($_POST["id_personnalite"])) {
    // Stockage dans des variables :
    $nom                = $_POST["nom"];
    $fonction           = $_POST["fonction"];
    $date_naissance     = $_POST["date_naissance"];
    $date_deces         = $_POST["date_deces"];
    $conjoint           = $_POST["conjoint"];
    $type_gisant        = $_POST["type_gisant"];
    $date_depot_gisant  = $_POST["date_depot_gisant"];
    // Mise à jour :
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("UPDATE personnalite SET nom ='$nom', fonction='$fonction', date_naissance='$date_naissance', date_deces='$date_deces', conjoint='$conjoint', type_gisant='$type_gisant', date_depot_gisant='$date_depot_gisant' WHERE id = ?");
    $stmt->execute(array($_POST["id_personnalite"]));

    // Memorise l' utilisateur qui a validé la personnalité :
    $stmt = $pdo->prepare("INSERT INTO historique_validation_personnalite (id_user, id_personnalite) VALUES (:id_user, :id_personnalite) ");
    $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
    $stmt->bindParam(':id_personnalite', $_POST["id_personnalite"]);
    $stmt->execute();

    echo "Mise à jour effectuée avec succès";
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
