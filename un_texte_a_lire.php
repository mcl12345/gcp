<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Lecture du texte : </h3>";

$is_non_valide = false;
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM document_texte WHERE id = ?");
$stmt->execute(array($_GET["id"]));
while ($row = $stmt->fetch()) {
    echo "<strong>Titre : </strong>" . $row["titre"] . "<br />";
    echo "<strong>Texte : </strong>" . $row["texte"] . "<br />";
    echo "<br /><br /><br />";
}
echo '</div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
