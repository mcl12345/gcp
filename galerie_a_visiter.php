<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM image");
$stmt->execute();


while ($row = $stmt->fetch()) {
  if($row['valide']) {
      $motscle = "";
      $motcle_empty = true;
      echo "<strong>Description : </strong>" . $row["description"] . "<br />";
      if($row["imageURL"] != null) {
        echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
      }
      $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_image = ?");
      $stmt_->execute(array($row["id"]));
      while ($ligne = $stmt_->fetch()) {
          $motcle_empty = false;
          $motscle .= " " . $ligne["contenu"] ;
      }
      if(!$motcle_empty) {
          echo "<strong>Les mots-clé : </strong>" . $motscle;
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
