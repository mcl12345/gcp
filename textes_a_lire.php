<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM texte");
if ($stmt->execute()) {
  echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
            <div class='container'>";
   while ($row = $stmt->fetch()) {

      if($row["valide"] == 1) {
        echo "<strong>Titre : </strong>" . $row["titre"] . "<br />";
        echo "<strong>texte : </strong>" . $row["texte"] . "<br />";
        echo "<br /><br /><br />";
      }
   }
   echo "</div></div></div>";
}

echo footer();

echo '</body>
</html>';

?>
