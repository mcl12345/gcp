<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

// Affichage du logo , du formulaire de recherche et du menu
print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
echo "<h3>Présentation du roi : </h3>";

if($_COOKIE["the_role"] == "administrateur") {
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


            if(isset($_POST["delete_commentaire"])) {
                $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                $stmt = $pdo->prepare("DELETE FROM commentaires WHERE idCommentaire = ?");
                $stmt->execute(array($_POST["delete_commentaire"]));
            }
            // Va chercher les commentaires
            $commentaire = array();
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE idRoi = ?");
            $stmt->execute(array($_GET["id_roi"]));
            $i = 0;
            while ($row = $stmt->fetch()) {
                $commentaire[$i] = array();
                $commentaire[$i]["id"] = $row["idCommentaire"];
                $commentaire[$i]["texte"] = $row["contenu"];
                $commentaire[$i]["date"] = $row["date"];

                // Va chercher l'auteur du commentaire
                $stmt_ = $pdo->prepare("SELECT * FROM user WHERE id = ?");
                $stmt_->execute(array($row["idUtilisateur"]));
                while ($ligne = $stmt_->fetch()) {
                    $commentaire[$i]["auteur"] = $ligne["username"];
                }
                $i++;
            }

            if(sizeof($commentaire) > 0) {
                echo "<form action='moderation.php?id_roi=" . $_GET["id_roi"] . "' method='post'>";
                // Affichage des commentaires :
                for ($i=0; $i < sizeof($commentaire) ; $i++) {
                    echo "<input name='delete_commentaire' type='radio' value='".$commentaire[$i]["id"]."' /> " . $commentaire[$i]["date"] . " - <strong>" . $commentaire[$i]["auteur"] . "</strong> : " . $commentaire[$i]["texte"] . "<br />";
                }
                echo "<input type='submit' value='Supprimer' />";
                echo "</form>";
            }

            echo "<br /><br />";
            echo "<a href='visualiser_un_roi.php?id_roi=".$_GET['id_roi']."'>Revenir à la page du roi</a>";

            echo '</div></div></div>';
    }
}
echo '</div></div></div>';

echo '</body></html>';

?>
