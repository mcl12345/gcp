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
$stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_chapelle");
$stmt->execute();

echo '<form action="chapelle_valide.php" method="post">';
while ($row = $stmt->fetch()) {
    if($row["valide"] == 0) {
        $stmt_ = $pdo->prepare("SELECT * FROM patrimoine_basilique_chapelle_description WHERE id_chapelle = ".$row['id']);
        $stmt_->execute();
        $is_non_valide = true;
        $i = 0;
        echo "<input type='radio' name='id_chapelle' value='".$row["id"]."' />";
        echo "<strong>nom : " . $row["nom"] . "</strong><br /><br />";
        while ($ligne = $stmt_->fetch()) {
            $i++;
            echo "<strong>titre".$i." : </strong>" . $ligne["titre"] . "</strong><br />";
            echo "<strong>description".$i." : </strong>" . $ligne["description"] . "<br />";
            echo "<strong>date".$i." : </strong>" . $ligne["date_description"] . "<br />";
            echo "<strong>composition".$i."</strong> : " . $ligne["composition"] . "<br /><br />";
        }
        echo "image : <img src='" . $row["imageURL"] . "' width='250px' height='250px' /><br />";
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
