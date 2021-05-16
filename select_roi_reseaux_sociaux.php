<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Choisir un roi pour lui ajouter des réseaux sociaux : </h3>";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM roi");
$stmt->execute();
$is_roi = false;
echo '<form action="ajout_roi_reseaux_sociaux.php" method="post">';
while ($row = $stmt->fetch()) {
        $is_roi = true;
        echo "<input type='radio' id='id_roi' name='id_roi' value='".$row["idRoi"]."' />";
        echo "<strong>Nom : </strong>" . $row["nomRoi"] . "<br />";
        echo "<strong>Durée du reigne : </strong>" . $row["dureeReigne"] . "<br />";
        echo "<strong>Dynastie : </strong>" . $row["dynastie"] . "<br />";
        echo "<strong>Description : </strong>" . $row["date_deces"] . "<br />";
        echo "<strong>photo : </strong><img src='https://basiliquesaintdenis.ovh/basilique-saint-denis/" . $row["photo"] . "' width='250' height='250' /><br /><br /><br /><br />";
}
if($is_roi) {
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
