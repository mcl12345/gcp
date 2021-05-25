<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4 rois'>";
echo "<h2>Les rois : </h2>";
echo '</div></div>';
echo '<br><br>';

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM roi");
$stmt->execute();
$size = 0;
while ($row = $stmt->fetch()) {
    $size++;
}
$is_roi = false;
echo '<form action="visualiser_un_roi.php" method="get">';
$i = 0;
$stmt = $pdo->prepare("SELECT * FROM roi");
$stmt->execute();
while ($row = $stmt->fetch()) {
        if($i == 0 || $i == 3 || $i == 6 || $i == 9 || $i == 12  || $i == 15 || $i == 18  || $i == 21 ) {
            echo "<div class='row decalage-rois'>";
        }
        echo "<div class='col-lg-4'>
        <div class='container'>";

        $is_roi = true;
        if($_SESSION["the_id"]) {
           echo "Cocher pour explorer : <input type='radio' id='id_roi' name='id_roi' value='".$row["idRoi"]."' /><br />";
        }
        echo "<strong>Nom : </strong>" . $row["nomRoi"] . "<br />";
        echo "<strong>Durée du reigne : </strong>" . $row["dureeReigne"] . " an(s)<br />";
        echo "<strong>Dynastie : </strong>" . $row["dynastie"] . "<br />";
        echo "<strong>Description : </strong>" . $row["description"] . "<br />";
		echo "<strong>Photo : </strong><a target='_blank' href='https://basiliquesaintdenis.ovh/basilique-saint-denis".$row["photo"]."'><br/>";
        echo "<img src='https://basiliquesaintdenis.ovh/basilique-saint-denis" . $row["photo"] . "' width='250' height='250' /></a><br /><br /><br /><br />";

        echo "</div></div>";

        // Size-1 == $i pour refermer correctement la div row
        if($i == 2 || $i == 5 || $i == 8 || $i == 11 || $i == 14 || $i == 17 || $i == 20 || $i == 23 || $size-1 == $i ) {
            echo "</div>";
        }
        $i++;
}
if($is_roi) {
  if($_SESSION["the_id"]) {
    echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>
              <div class='container'>";
      echo "<input value='Explorer' type='submit' />";
      echo '</div></div></div>';
  }
  echo "</form><br />";
} else {
    echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
            <div class='container'>";
    echo "La liste est vide !";
    echo '</div></div></div>';
}

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
