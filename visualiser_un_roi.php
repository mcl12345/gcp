<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Présentation du roi : </h3>";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM roi WHERE idRoi = ?");
$stmt->execute(array($_GET["id_roi"]));
$is_roi = false;

while ($row = $stmt->fetch()) {
        $is_roi = true;
        echo "<strong>Nom : </strong>" . $row["nomRoi"] . "<br />";
        echo "<strong>Durée du reigne : </strong>" . $row["dureeReigne"] . "<br />";
        echo "<strong>Dynastie : </strong>" . $row["dynastie"] . "<br />";
        echo "<strong>Description : </strong>" . $row["description"] . "<br />";
        echo "<strong>photo : </strong><img src='" . $row["photo"] . "' width='250' height='250' /><br /><br /><br /><br />";

        // Formulaire commentaire
        echo '<form action="visualiser_un_roi.php?id_roi='.$_GET["id_roi"].'" method="post">';
            //echo "<input type='radio' id='id_roi' name='id_roi' value='".$row["idRoi"]."' />";
            echo "<label for='contenu'>Commentaire : </label><input type='text' id='contenu' name='contenu' /><br />";
            //echo "<label for='date_commentaire'>Date : </label><input type='text' id='date_commentaire' name='date_commentaire' />";
            echo "<input type='hidden' id='id_user' name='id_user' value='".$_COOKIE["the_id"]."' />";
            echo "<input type='submit' value='Envoyer' />";
        echo '</form><br /><br />';

        if(isset($_POST["contenu"])) {
            $now = new DateTime();
            $la_date = $now->format('Y-m-d H:i:s');
            $_stmt_ = $pdo->prepare("INSERT INTO commentaires (contenu, dateCommentaire, idUtilisateur, idRoi) VALUES (:contenu, :dateCommentaire, :idUtilisateur, :idRoi)");
            $_stmt_->bindParam(':contenu', $_POST["contenu"]);
            $_stmt_->bindParam(':dateCommentaire', $la_date);
            $_stmt_->bindParam(':idUtilisateur', $_COOKIE["the_id"]);
            $_stmt_->bindParam(':idRoi', $_GET["id_roi"]);
            $_stmt_->execute();
        }

        // Affichage des commentaires
        $stmt_ = $pdo->prepare("SELECT * FROM commentaires WHERE idRoi = ?");
        $stmt_->execute(array($_GET["id_roi"]));
        while ($ligne = $stmt_->fetch()) {

            $stmt__ = $pdo->prepare("SELECT * FROM user WHERE id = ?");
            $stmt__->execute(array($ligne["idUtilisateur"]));

            while ($ligne_ = $stmt__->fetch()) {
                echo $ligne["dateCommentaire"] . " : ";
                echo $ligne_["username"] . " : ";
                echo $ligne["contenu"] . "<br />";
            }
        }
        // fin affichage des commentaires
}
if($is_roi) {
} else {
    echo "L'identifiant du roi n'est pas correct !";
}
echo '</div></div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
