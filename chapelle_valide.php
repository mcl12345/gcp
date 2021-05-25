<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation Chapelle : </h3><br /><br />";

// Changement de la validité à 1

if (isset($_POST["id_chapelle"])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // Va chercher la chapelle :
  $stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_chapelle WHERE id = ?");
  $stmt->execute(array($_POST["id_chapelle"]));
  while ($row = $stmt->fetch()) {
      $stmt_ = $pdo->prepare("SELECT * FROM patrimoine_basilique_chapelle_description WHERE id_chapelle = ".$row['id']);
      $stmt_->execute();
      echo "<strong>nom : " . $row["nom"] . " a été validé.</strong> <br />";
      while ($ligne = $stmt_->fetch()) {
          echo "<br /><strong>titre".$i." : " . $ligne["titre"] . "</strong><br />";
          echo "description".$i." : " . $ligne["description"] . "<br />";
          echo "date".$i." : " . $ligne["date_description"] . "<br />";
          echo "composition".$i." : " . $ligne["composition"] . "<br /><br />";
      }
      echo "image : <img src='" . $row["imageURL"] . "' width='250px' height='250px' /><br />";
      echo "<br /><br /><br />";
  }

  // Change la validité à 1
  $stmt = $pdo->prepare("UPDATE patrimoine_basilique_chapelle SET valide = 1 WHERE id = ?");
  $stmt->execute(array($_POST["id_chapelle"]));

  // Memorise l' utilisateur qui a validé les medias.
  $stmt = $pdo->prepare("INSERT INTO historique_validation_chapelle (id_user, id_chapelle) VALUES (:id_user, :id_chapelle) ");
  $stmt->bindParam(':id_user', $_SESSION["the_id"]);
  $stmt->bindParam(':id_chapelle', $_POST["id_chapelle"]);
  $stmt->execute();
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
