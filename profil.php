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
  echo "<form action='profil.php' method='post'>
            <label class='label_formulaire' for='nom'>Nom : </label><input id='nom' name='nom' value='".$nom."' type='text' /><br />
            <label class='label_formulaire' for='prenom'>Prénom : </label><input id='prenom' name='prenom' value='".$prenom."' type='text' /><br />
            <label class='label_formulaire' for='email'>Email : </label><input id='email' name='email' value='".$email."' size='30' type='text' /><br />
            <input value='Confirmer' type='submit' />
    </form><br />";

if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // Va chercher la personnalité :
  $stmt = $pdo->prepare("INSERT INTO profil ( nom, prenom, email, id_user) VALUES (:nom, :prenom, :email, :id_user)");
  $stmt->bindParam(':nom', $_POST['nom']);
  $stmt->bindParam(':prenom', $_POST['prenom']);
  $stmt->bindParam(':email', $_POST['email']);
  $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
  $stmt->execute();

  echo "Le profil de " . $_POST['nom'] . " a été correctement mis-à-jour";
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
