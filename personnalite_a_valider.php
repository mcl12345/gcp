<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation Personnalité : </h3>";

$is_non_valide = false;
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite");
$stmt->execute();

echo '<form action="personnalite_valide.php" method="post">';
while ($row = $stmt->fetch()) {
    if($row["valide"] == 0) {
        $is_non_valide = true;
        echo "<input type='radio' name='id_personnalite' value='".$row["id"]."' />";
        echo "nom : " . $row["nom"] . "<br />";
        echo "fonction : " . $row["fonction"] . "<br />";
        echo "date de naissance : " . $row["date_naissance"] . "<br />";
        echo "date de décès : " . $row["date_deces"] . "<br />";
        echo "conjoint : " . $row["conjoint"] . "<br />";
        echo "type de gisant : " . $row["type_gisant"] . "<br />";
        echo "date du dépôt du gisant : " . $row["date_depot_gisant"] . "<br /><br /><br />";
    }
}
if($is_non_valide) {
  echo "<input value='Valider' type='submit' />";
  echo "</form><br />";
} else {
  echo "La liste est vide !";
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
