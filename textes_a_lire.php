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
				<div class='col-md-4 col-md-offset-4'>";
$is_texte = false;
while($row = $stmt->fetch()) {
		if($row["valide"] == 1) {
				$is_texte = true;
				echo "<a target='_blank' href='un_texte_a_lire.php?id=" . $row["id"] . "'><strong>Titre : </strong>" . $row["titre"] . "</a><br />";
				echo "<strong>Texte : </strong>" . substr($row["texte"], 0, 200) . "<br /><br /><br />";
				//echo mb_strimwidth($row["texte"], 0, 10, '...');
		}
}
if(!$is_texte) {
		echo "Aucun texte validé pour le moment.";
}
echo "</div></div></div>";



echo footer();

echo '</body>
</html>';

?>
