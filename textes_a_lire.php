<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM document_texte");
$stmt->execute();
echo "<div class='container'>
			<div class='row'>
			<div class='container-set-textes-a-lire'>";
$is_texte = false;
while($row = $stmt->fetch()) {
		if($row["valide"] == 1) {
				$is_texte = true;
				if($_COOKIE["the_role"] == "administrateur") {          
              		echo "<form action='textes_a_lire.php' method='get'>";
              		echo "Cocher pour supprimer : <input type='radio' name='id_document_texte' value='".$row["id"]."' /><br />";
          		}
				echo "<a target='_blank' href='un_texte_a_lire.php?id=" . $row["id"] . "'><h4><strong>Titre : </strong>" . $row["titre"] . "</h4></a><br />";
				echo "<strong>Texte : </strong>" . mb_strimwidth($row["texte"], 0, 300,'...') . "<br /><br /><br />";
				//echo mb_strimwidth($row["texte"], 0, 10, '...');
		}
}
if(!$is_texte) {
	echo "Aucun texte validé pour le moment.";
}

if($_COOKIE["the_role"] == "administrateur" && $is_texte) {
    echo "<input type='submit' value='Supprimer' />
    </form>";
}

// Suppression
if(isset($_GET["id_document_texte"])) {
	// Suppression du document
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt_ = $pdo->prepare("DELETE FROM document_texte WHERE id = ?");
    $stmt_->execute(array($_GET["id_document_texte"]));

	// Suppression du motcle
	$stmt_ = $pdo->prepare("SELECT * FROM mot_document_texte WHERE id_document_texte = ?");
    $stmt_->execute(array($_GET["id_document_texte"]));
    while($row = $stmt_->fetch()) {
    	$_stmt_ = $pdo->prepare("DELETE FROM mot_texte WHERE id = ?");
    	$_stmt_->execute(array($row["id_mot_texte"]));
    }

	// Suppression du mot_document_texte qui lie les motscle et les documents :
    $stmt_ = $pdo->prepare("DELETE FROM mot_document_texte WHERE id_document_texte = ?");
    $stmt_->execute(array($_GET["id_document_texte"]));
}

echo "</div></div></div>";



echo footer();

echo '</body>
</html>';

?>
