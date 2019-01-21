<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite");
$stmt->execute();
//obtenir numbre de id
$count = $stmt->rowCount();
//obtenir numebre de pages
$count_pagination = $count/8+1;
$pagination_last = $count/8;
$page=0;
$maxi_afficher = 8;



echo "<div class='row'>";
echo "<div class='container-set-personnalites'>";
//while ($row = $stmt->fetch()) {

	//gauche
	if($count_pagination>1){
		//$row = $stmt->fetch();
		$page=1;
		$page=$_GET["page"];
		$search = $_POST["search"];
		//premier page
		if($page==1){
			//le premier row
			$search = $maxi_afficher*$page;
			$row = $stmt->fetch();
			for($i=1; $i<=$maxi_afficher; $i++){
				 echo "<div class='col-lg-6 container-left'>";
				  if($row['valide']) {
					  echo "<strong>nom : </strong>" . $row["nom"] . "<br />";
					  echo "<strong>fonction : </strong>" . $row["fonction"] . "<br />";
					  echo "<strong>date de naissance : </strong>" . $row["date_naissance"] . "<br />";
					  echo "<strong>date de décès : </strong>" . $row["date_deces"] . "<br />";
					  echo "<strong>conjoint : </strong>" . $row["conjoint"] . "<br />";
					  echo "<strong>type de gisant : </strong>" . $row["type_gisant"] . "<br />";
					  echo "<strong>date du dépôt du gisant : </strong>" . $row["date_depot_gisant"] . "<br />";
					  if($row["imageURL"] != null) {
								echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
					  }
					  echo "<br /><br /><br />";
				  }
				echo "</div>";
				$row = $stmt->fetch();
			}//for
		}else{
		//deuxieme page	--> la dernier deux page (2-7)
		//$row = $stmt->fetch();
			$cid = $maxi_afficher*($page-1)+1;
			$stmt_id = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite WHERE id=$cid");
			$stmt_id->execute();
			$search = $maxi_afficher*$page;
			$row = $stmt_id->fetch();
			for($i=$cid; $i<=$maxi_afficher*$page; $i++){
				 echo "<div class='col-lg-6 container-left'>";
				  if($row['valide']) {
					  echo "<strong>nom : </strong>" . $row["nom"] . "<br />";
					  echo "<strong>fonction : </strong>" . $row["fonction"] . "<br />";
					  echo "<strong>date de naissance : </strong>" . $row["date_naissance"] . "<br />";
					  echo "<strong>date de décès : </strong>" . $row["date_deces"] . "<br />";
					  echo "<strong>conjoint : </strong>" . $row["conjoint"] . "<br />";
					  echo "<strong>type de gisant : </strong>" . $row["type_gisant"] . "<br />";
					  echo "<strong>date du dépôt du gisant : </strong>" . $row["date_depot_gisant"] . "<br />";
					  if($row["imageURL"] != null) {
						echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
					  }
					  echo "<br /><br /><br />";
				  }
				echo "</div>";
				$stmt_id = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite WHERE id=$i+1");
				$stmt_id->execute();
				$row = $stmt_id->fetch();

			}//for
		}/*else{
			//dernier page (8)
			$cid = $maxi_afficher*($page-1)+1;
			$stmt_id = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite WHERE id=$cid");
			$stmt_id->execute();
			$search = $count-$maxi_afficher*($page-1);
			$row = $stmt_id->fetch();
			for($i=$cid; $i<=$search; $i++){
				 echo "<div class='col-lg-6 container-left'>";
				  if($row['valide']) {
					  echo "<strong>nom : </strong>" . $row["nom"] . "<br />";
					  echo "<strong>fonction : </strong>" . $row["fonction"] . "<br />";
					  echo "<strong>date de naissance : </strong>" . $row["date_naissance"] . "<br />";
					  echo "<strong>date de décès : </strong>" . $row["date_deces"] . "<br />";
					  echo "<strong>conjoint : </strong>" . $row["conjoint"] . "<br />";
					  echo "<strong>type de gisant : </strong>" . $row["type_gisant"] . "<br />";
					  echo "<strong>date du dépôt du gisant : </strong>" . $row["date_depot_gisant"] . "<br />";
					  if($row["imageURL"] != null) {
						echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
					  }
					  echo "<br /><br /><br />";
				  }
				echo "</div>";
				$stmt_id = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite WHERE id=$i+1");
				$stmt_id->execute();
				$row = $stmt_id->fetch();

			}//for
		}*/


	}
	if($count_pagination==1){
		while ($row = $stmt->fetch()) {
			echo "<br /><br /><div class='col-lg-6 container-left'>";
			  if($row['valide']) {
				  echo "<strong>nom : </strong>" . $row["nom"] . "<br />";
				  echo "<strong>fonction : </strong>" . $row["fonction"] . "<br />";
				  echo "<strong>date de naissance : </strong>" . $row["date_naissance"] . "<br />";
				  echo "<strong>date de décès : </strong>" . $row["date_deces"] . "<br />";
				  echo "<strong>conjoint : </strong>" . $row["conjoint"] . "<br />";
				  echo "<strong>type de gisant : </strong>" . $row["type_gisant"] . "<br />";
				  echo "<strong>date du dépôt du gisant : </strong>" . $row["date_depot_gisant"] . "<br />";
				  if($row["imageURL"] != null) {
					echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
				  }
				  echo "<br /><br /><br />";
			  }
			 echo "</div>";
		}//while
	}

/*}*/

echo "<br />";
echo '</div></div>';

//affiche pagination

if($count_pagination>1){
	echo "<div class='container-pagination'>";
	echo "<ul class='pagination'>";
	for($i=1; $i<=$count_pagination; $i++){
		if($page==$i){
				echo '<li class="active"><a href="personnalites.php?page='.$i.'&search='.$search.'">'.$i. '</a></li>';
		}else{
			echo '<li><a href="personnalites.php?page='.$i.'&search='.$search.'">'.$i. '</a></li>';
		}
	}
	echo "</ul>";
	echo "</div>";
}


echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
