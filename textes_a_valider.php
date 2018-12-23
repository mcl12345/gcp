<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation Texte : </h3>";

$is_non_valide = false;
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM document_texte");
$stmt->execute();

echo '<form action="textes_valide.php" method="post">';
while ($row = $stmt->fetch()) {
    if($row["valide"] == 0) {
        $is_non_valide = true;
        echo "<input type='radio' name='id_texte' value='".$row["id"]."' /><br />";
        echo "<strong>Titre : </strong><a target='_blank' href='un_texte_a_lire.php?id=".$row["id"]."'>" . $row["titre"] . "</a><br />";
        echo "<strong>Texte : </strong>" . substr($row["texte"], 0, 200) . "<br />";
        echo "<br /><br /><br />";
    }
}
if($is_non_valide) {
  echo "<input value='Valider' type='submit' />";
  echo "</form><br />";
} else {
  echo "La liste est vide !";
}
echo '</div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
