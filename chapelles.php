<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_chapelle");
$stmt->execute();
echo "<div class='row'>
        <div class='col-lg-2'></div>
        <div class='col-lg-4'>
            <div class='container'>";
while ($row = $stmt->fetch()) {
      $stmt_ = $pdo->prepare("SELECT * FROM patrimoine_basilique_chapelle_description WHERE id_chapelle = ?");
      $stmt_->execute(array($row["id"]));
      if($row["valide"] == 1) {
          $i = 0;
          echo "<strong>nom : </strong>" . $row["nom"] . "<br />";
          while ($ligne = $stmt_->fetch()) {
              $i++;
              echo "<strong>titre".$i." : </strong>" . $ligne["titre"] . "<br />";
              echo "<strong>description".$i." : </strong>" . $ligne["description"] . "<br />";
              echo "<strong>date".$i." : </strong>" . $ligne["date_description"] . "<br />";
              echo "<strong>composition".$i." : </strong>" . $ligne["composition"] . "<br /><br />";
          }
          echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
          echo "<br /><br /><br />";
      }
}
echo "</div></div></div>";


echo footer();

echo '</body>
</html>';

?>
