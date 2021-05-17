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
      if($_COOKIE["the_role"] == "administrateur") {
          echo "<form action='galerie_a_visiter.php' method='get'>";
          echo "Cocher pour supprimer : <input type='radio' name='id_image' value='".$row["id"]."' /><br />";
      }
      echo "<strong>Titre : </strong>" . $row["titre"] . "<br />";
      echo "<strong>Description : </strong>" . $row["description"] . "<br />";
      if($row["imageURL"] != null) {
          echo "<strong>image : </strong><a target='_blank' href='https://basiliquesaintdenis.ovh/basilique-saint-denis".$row["imageURL"]."'><img src='https://basiliquesaintdenis.ovh/basilique-saint-denis" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
      }


      // Les mots-clé :
      $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 2");
      $stmt_->execute(array($row["id"]));
      while ($ligne = $stmt_->fetch()) {
          $motcle_empty = false;
          $motscle .= " " . $ligne["mots_cle"] ;
      }
      if(!$motcle_empty) {
          echo "<strong>Les mots-clé : </strong>" . $motscle;
      }
      echo "<br /><br /><br />";
  }
}

echo "<br />";
if($_COOKIE["the_role"] == "administrateur") {
    echo "<input type='submit' value='Supprimer' />
    </form>";
}
if(isset($_GET["id_image"])) {
    // Suppression du fichier image
    $stmt_ = $pdo->prepare("SELECT * FROM image WHERE id = ?");
    $stmt_->execute(array($_GET["id_image"]));
    while($row = $stmt_->fetch()) {
        $position = stripos($row["imageURL"], "upload_images/");
        $delete_image = substr($row["imageURL"], $position, strlen($row["imageURL"])-$position);
        unlink($delete_image);
    }

    // Suppression de la table
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt_ = $pdo->prepare("DELETE FROM image WHERE id = ?");
    $stmt_->execute(array($_GET["id_image"]));

    // Suppression des mots-cle
    $stmt_ = $pdo->prepare("DELETE FROM motcle WHERE id_media = ? AND type_media = 2");
    $stmt_->execute(array($_GET["id_image"]));
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
