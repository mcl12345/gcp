<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Ajout réseaux sociaux : </h3>";

$lien_facebook_page = "";
$lien_facebook_groupe = "";
$lien_instagram_compte = "";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
  // Va chercher le roi connecté aux rédeaux sociaux :
$stmt = $pdo->prepare("SELECT * FROM reseauxsociauxroi WHERE idRoi = ?");
$stmt->execute(array($_POST["id_roi"]));
while ($row = $stmt->fetch()) {
    $lien_facebook_page = $row["lienFacebookPage"];
    $lien_facebook_groupe = $row["lienFacebookGroupe"];
    $lien_instagram_compte = $row["lienInstagramCompte"];
}

if (isset($_POST["id_roi"])) {
  echo "<form action='ajout_roi_reseaux_sociaux.php' method='post' >";
  echo '<input id="idroi" name="idroi" type="hidden" value="'.$_POST["id_roi"].'" /><br />';
  echo '<label class="label_formulaire" for="lien_facebook_page">Lien Facebook page : </label><input id="lien_facebook_page" name="lien_facebook_page" value="'.$lien_facebook_page.'" /><br />';
  echo '<label class="label_formulaire" for="lien_facebook_group">Lien Facebook groupe : </label><input id="lien_facebook_group" name="lien_facebook_group" value="'.$lien_facebook_groupe.'" /><br />';
  echo '<label class="label_formulaire" for="lien_instagram_compte">Lien du compte Instagram : </label><input id="lien_instagram_compte" name="lien_instagram_compte" value="'.$lien_instagram_compte.'" /><br />';
  echo "<input type='submit' value='Modifier' />";
  echo "</form>";
} else if (isset($_POST["idroi"]) && (isset($_POST["lien_facebook_page"]) || isset($_POST["lien_facebook_group"]) || isset($_POST["lien_instagram_compte"]))) {
    $lien_facebook_page = $_POST["lien_facebook_page"];
    $lien_facebook_groupe = $_POST["lien_facebook_group"];
    $lien_instagram_compte = $_POST["lien_instagram_compte"];
    $id_roi = $_POST["idroi"];
    $stmt = $pdo->prepare("INSERT INTO reseauxsociauxroi (lienFacebookPage, lienFacebookGroupe, lienInstagramCompte, idRoi) VALUES (:lienFacebookPage, :lienFacebookGroupe, :lienInstagramCompte, :idRoi)");
    $stmt->bindParam(":lienFacebookPage", $lien_facebook_page);
    $stmt->bindParam(":lienFacebookGroupe", $lien_facebook_groupe);
    $stmt->bindParam(":lienInstagramCompte", $lien_instagram_compte);
    $stmt->bindParam(":idRoi", $id_roi);
    $stmt->execute();

    echo "Votre enregistrement des réseaux sociaux a été pris en compte.";
}

echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
