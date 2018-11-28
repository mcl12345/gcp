<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
// connexion à la bdd
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM video");
if ($stmt->execute()) {
  echo "<div class='row'>
        <div class='col-lg-2'></div>
        <div class='col-lg-4'>
            <div class='container'>";
   while ($row = $stmt->fetch()) {

      if($row["valide"] == 1) {
          $motscle = "";
          $motcle_empty = true;
          echo "<strong>Description : </strong>" . $row["description"] . "<br /><br />";
          echo '<strong>Vidéo : </strong><br /><video width="400" height="222" controls="controls">
                             <source src="'.$row["videoURL"].'" type="video/webm" />
                             Vous n\'avez pas de navigateur moderne, donc pas de balise video HTML5 !</video>';
         echo "<br /><br />";

         $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_video = ?");
         $stmt_->execute(array($row["id"]));
         while ($ligne = $stmt_->fetch()) {
             $motcle_empty = false;
             $motscle .= " " . $ligne["contenu"];
         }
         if(!$motcle_empty) {
             echo "<strong>Les mots-clé : </strong>" . $motscle;
         }


    echo "<br /><br /><br />";
      }
   }
   echo "</div></div></div>";
}

echo footer();

echo '</body>
</html>';

?>
