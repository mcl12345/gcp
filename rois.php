<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4 rois'>";
echo "<h3>Tous les rois : </h3>";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM roi");
$stmt->execute();
$is_roi = false;
echo '<form action="visualiser_un_roi.php" method="get">';
while ($row = $stmt->fetch()) {
        $is_roi = true;
        echo "Cocher pour explorer : <input type='radio' id='id_roi' name='id_roi' value='".$row["idRoi"]."' /><br />";
        echo "<strong>Nom : </strong>" . $row["nomRoi"] . "<br />";
        echo "<strong>Durée du reigne : </strong>" . $row["dureeReigne"] . "<br />";
        echo "<strong>Dynastie : </strong>" . $row["dynastie"] . "<br />";
        echo "<strong>Description : </strong>" . $row["description"] . "<br />";
        echo "<strong>photo : </strong><a target='_blank' href='".$row["photo"]."'><img src='" . $row["photo"] . "' width='250' height='250' /></a><br /><br /><br /><br />";
}
if($is_roi) {
  echo "<input value='Explorer' type='submit' />";
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
