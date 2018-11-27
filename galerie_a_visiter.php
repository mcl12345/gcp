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
      echo "<strong>Description : </strong>" . $row["description"] . "<br />";
      if($row["imageURL"] != null) {
        echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
      }
      if($row["mot_cle1"] != null) { 
      	echo "mot-clé 1 : " . $row["mot_cle1"] . "<br />";
      }

      if($row["mot_cle2"] != null) { 
      	echo "mot-clé 2 : " . $row["mot_cle2"] . "<br />";
      }

      if($row["mot_cle3"] != null) { 
      	echo "mot-clé 3 : " . $row["mot_cle3"] . "<br />";
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
