<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Validation Image : </h3>";

$is_non_valide = false;
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM image");
$stmt->execute();

echo '<form action="images_valide.php" method="post">';
while ($row = $stmt->fetch()) {
    if($row["valide"] == 0) {
        $is_non_valide = true;
        $motscle = "";
        $motcle_empty = true;
        echo "<input type='radio' name='id_image' value='".$row["id"]."' />";
        echo "Titre : " . $row["titre"] . "<br />";
        echo "Description : " . $row["description"] . "<br />";
        echo "image : <a target='_blank' href='".$row["imageURL"]."'><img width='250px' height='250px' src='".$row["imageURL"] . "'/></a><br />";

        $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 2");
        $stmt_->execute(array($row["id"]));
        while ($ligne = $stmt_->fetch()) {
            $motcle_empty = false;
            $motscle .= " " . $ligne["mots_cle"];
        }
        if(!$motcle_empty) {
            echo "<strong>Les mots-clé : </strong>" . $motscle;
        }

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