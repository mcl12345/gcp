<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<br><br><br>";
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-5'>";
  echo "<h3>Profil : </h3>";

  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // Va chercher la personnalité :
  $stmt = $pdo->prepare("SELECT * FROM profil WHERE id_user = ?");
  $stmt->execute(array($_COOKIE["the_id"]));
  while ($row = $stmt->fetch()) {
      $nom = $row["nom"];
      $prenom = $row["prenom"];
      $email = $row["email"];
  }
  
if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // Va supprimer le profil et le compte utilisateur :
  $stmt = $pdo->exec("DELETE FROM profil WHERE nom = '".$_POST["nom"]."', prenom = '".$_POST["prenom"]."', email = '".$_POST["email"]."'");
  $stmt = $pdo->exec("DELETE FROM user WHERE id = " .$_COOKIE["the_id"]);

  echo "Le profil et le compte " . $_POST['nom'] . " ont bien été supprimés.";
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
