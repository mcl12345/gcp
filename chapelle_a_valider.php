<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation Chapelle : </h3>";

$is_non_valide = false;
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM chapelle");
$stmt->execute();

echo '<form action="chapelle_valide.php" method="post">';
while ($row = $stmt->fetch()) {
    if($row["valide"] == 0) {
        $is_non_valide = true;
        echo "<input type='radio' name='id_chapelle' value='".$row["id"]."' />";
        echo "nom : " . $row["nom"] . "<br />";
        echo "titre1 : " . $row["titre1"] . "<br />";
        echo "description1 : " . $row["description1"] . "<br />";
        echo "date1 : " . $row["date1"] . "<br />";
        echo "composition1 : " . $row["composition1"] . "<br />";
        echo "titre2 : " . $row["titre2"] . "<br />";
        echo "description2 : " . $row["description2"] . "<br />";
        echo "date2 : " . $row["date2"] . "<br />";
        echo "composition2 : " . $row["composition2"] . "<br />";
        echo "titre3 : " . $row["titre3"] . "<br />";
        echo "description3 : " . $row["description3"] . "<br />";
        echo "date3 : " . $row["date3"] . "<br />";
        echo "composition3 : " . $row["composition3"] . "<br />";
        echo "titre4 : " . $row["titre4"] . "<br />";
        echo "description4 : " . $row["description4"] . "<br />";
        echo "date4 : " . $row["date4"] . "<br />";
        echo "composition4 : " . $row["composition4"] . "<br />";
        echo "titre5 : " . $row["titre5"] . "<br />";
        echo "description5 : " . $row["description5"] . "<br />";
        echo "date5 : " . $row["date5"] . "<br />";
        echo "composition5 : " . $row["composition5"] . "<br />";
        echo "image : " . $row["imageURL"] . "<br />";
        echo "<br /><br /><br />";
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
