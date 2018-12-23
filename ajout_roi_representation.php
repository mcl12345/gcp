<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
// Va chercher le roi :
$stmt = $pdo->prepare("SELECT * FROM roi WHERE idRoi = ?");
$stmt->execute(array($_POST["id_roi"]));
while ($row = $stmt->fetch()) {
    echo "<h3>Ajout de représentation(s) pour le roi ".$row["nomRoi"]." : </h3>";
}

$paysRepresentation = "";
$villeRepresentation = "";
$typeRepresentation = "";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
  // Va chercher le roi connecté aux rédeaux sociaux :
$stmt = $pdo->prepare("SELECT * FROM associationrr WHERE idRoi = ?");
$stmt->execute(array($_POST["id_roi"]));
while ($row = $stmt->fetch()) {
    $stmt_ = $pdo->prepare("SELECT * FROM representationsroi WHERE idRepresentationsRoi = ?");
    $stmt_->execute(array($row["idRepresentationRoi"]));
    while ($ligne = $stmt_->fetch()) {
        echo "paysRepresentation : " . $ligne["paysRepresentation"] . "<br />";
        echo "villeRepresentation : " . $ligne["villeRepresentation"] . "<br />";
        echo "typeRepresentation : " . $ligne["typeRepresentation"] . "<br /><br />";
    }
}

if (isset($_POST["id_roi"])) {
  echo "<form action='ajout_roi_representation.php' method='post' >";
  echo '<input id="idroi" name="idroi" type="hidden" value="'.$_POST["id_roi"].'" /><br />';
  echo '<label class="label_formulaire" for="paysRepresentation">Pays de representation : </label><input id="paysRepresentation" name="paysRepresentation" /><br />';
  echo '<label class="label_formulaire" for="villeRepresentation">Ville de representation : </label><input id="villeRepresentation" name="villeRepresentation" /><br />';
  echo '<label class="label_formulaire" for="typeRepresentation">Type de representation : </label><input id="typeRepresentation" name="typeRepresentation" /><br />';
  echo "<input type='submit' value='Ajouter' />";
  echo "</form>";
} else if (isset($_POST["idroi"]) && (isset($_POST["paysRepresentation"]) || isset($_POST["villeRepresentation"]) || isset($_POST["typeRepresentation"]))) {
    $paysRepresentation = $_POST["paysRepresentation"];
    $villeRepresentation = $_POST["villeRepresentation"];
    $typeRepresentation = $_POST["typeRepresentation"];
    $id_roi = $_POST["idroi"];
    $stmt = $pdo->prepare("INSERT INTO representationsroi (paysRepresentation, villeRepresentation, typeRepresentation) VALUES (:paysRepresentation, :villeRepresentation, :typeRepresentation)");
    $stmt->bindParam(":paysRepresentation", $paysRepresentation);
    $stmt->bindParam(":villeRepresentation", $villeRepresentation);
    $stmt->bindParam(":typeRepresentation", $typeRepresentation);
    $stmt->execute();
    $last_id_representation = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO associationrr (idRepresentationRoi, idRoi) VALUES (:idRepresentationRoi, :idRoi)");
    $stmt->bindParam(":idRepresentationRoi", $last_id_representation);
    $stmt->bindParam(":idRoi", $id_roi);
    $stmt->execute();

    echo "La représentation a bien été enregistré.";
}

echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
