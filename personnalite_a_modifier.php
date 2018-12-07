<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Modification : </h3>";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite");
$stmt->execute();

echo '<form action="personnalite_modification.php" method="get">';
while ($row = $stmt->fetch()) {
    echo "<input type='radio' name='id_personnalite' value='".$row["id"]."' />";
    echo "<strong>nom : </strong>" . $row["nom"] . "<br />";
    echo "<strong>fonction : </strong>" . $row["fonction"] . "<br />";
    echo "<strong>date de naissance : </strong>" . $row["date_naissance"] . "<br />";
    echo "<strong>date de décès : </strong>" . $row["date_deces"] . "<br />";
    echo "<strong>conjoint : </strong>" . $row["conjoint"] . "<br />";
    echo "<strong>type de gisant : </strong>" . $row["type_gisant"] . "<br />";
    echo "<strong>date du dépôt du gisant : </strong>" . $row["date_depot_gisant"] . "<br />";
    echo "<strong>image : </strong><img src='" . $row["imageURL"] . "' width='250px' height='250px' /><br />";
    echo "<br /><br /><br />";
}
echo "<input value='Modifier' type='submit' />";
echo "</form><br />";
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
