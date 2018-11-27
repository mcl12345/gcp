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
$stmt = $pdo->prepare("SELECT * FROM video");
$stmt->execute();

echo '<form action="video_valide.php" method="post">';
while ($row = $stmt->fetch()) {
    if($row["valide"] == 0) {
        $is_non_valide = true;
        echo "<input type='radio' name='id_video' value='".$row["id"]."' />";
        echo "Description : " . $row["description"] . "<br />";
        // voir ogg
        echo 'Vidéo : <video width="400" height="222" controls="controls">
        <source src="'.$row["videoURL"].'" type="video/webm" />        
          Vous n\'avez pas de navigateur moderne, donc pas de balise video HTML5 !</video>';
        echo "mot-clé 1 : " . $row["mot_cle1"] . "<br />";
        echo "mot-clé 2 : " . $row["mot_cle2"] . "<br />";
        echo "mot-clé 3 : " . $row["mot_cle3"] . "<br />";
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
