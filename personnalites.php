<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM personnalite");
$stmt->execute();


while ($row = $stmt->fetch()) {
  if($row['valide']) {
      echo "<strong>nom : </strong>" . $row["nom"] . "<br />";
      echo "<strong>fonction : </strong>" . $row["fonction"] . "<br />";
      echo "<strong>date de naissance : </strong>" . $row["date_naissance"] . "<br />";
      echo "<strong>date de décès : </strong>" . $row["date_deces"] . "<br />";
      echo "<strong>conjoint : </strong>" . $row["conjoint"] . "<br />";
      echo "<strong>type de gisant : </strong>" . $row["type_gisant"] . "<br />";
      echo "<strong>date du dépôt du gisant : </strong>" . $row["date_depot_gisant"] . "<br />";
      if($row["imageURL"] != null) {
        echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
      }
      echo "<br /><br /><br />";
  }
}
echo "<br />";
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
