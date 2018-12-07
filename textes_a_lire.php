<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM texte");
$stmt->execute();
echo "<div class='container'>
			<div class='row'>
				<div class='col-md-4 col-md-offset-4'>";
					while($row = $stmt->fetch()) {

						if($row["valide"] == 1) {
							$motscle = "";
							$motcle_empty = true;
							$type_media;
							echo "<strong>Titre : </strong>" . $row["titre"] . "<br />";
							//TODO CUT LE TEXT

							echo "<strong>texte : </strong>" . $row["texte"] . "<br /><br /><br />";
							//echo mb_strimwidth($row["texte"], 0, 10, '...');

							// -------------------------------
							// Affichage des mots-clé
							// -------------------------------
							$stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = ".$type_media);
							$stmt_->execute(array($row["id"]));
							while ($ligne = $stmt_->fetch()) {
								$motcle_empty = false;
								$motscle .= " " . $ligne["mots_cle"];
							}
							if(!$motcle_empty) {
									echo "<strong>Les mots-clé : </strong>" . $motscle;
							}
							// -------------------------------
							// fin d'affichage des mots-clé
							// -------------------------------
						}

					}
echo "</div></div></div>";



echo footer();

echo '</body>
</html>';

?>
