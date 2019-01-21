<?php
include("connection_bdd.php");
include('logo_search_menu.php');
include('footer.php');
print_LOGO_FORMSEARCH_MENU();

if(!empty($_POST["name"]) &&
	!empty($_POST["email"]) &&
	!empty($_POST["mobile"]) &&
	!empty($_POST["subject"]) &&
	!empty($_POST["message"])) {
		$name=$_POST["name"];
		$email=$_POST["email"];
		$mobile=$_POST["mobile"];
		$subject=$_POST["subject"];
		$message=$_POST["message"];

			$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
			$stmt = $pdo->prepare("INSERT INTO contact_nous (nom,email,numero_telephone,sujet,message) VALUES (:nom,:email,:numero_telephone,:sujet,:message)");
			$stmt->bindParam(':nom', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':numero_telephone', $mobile);
			$stmt->bindParam(':sujet', $subject);
			$stmt->bindParam(':message', $message);
			$stmt->execute();

			//echo "<div class='container-set-contact-nous-text'>";
			echo "<div class='row'>
			          <div class='col-lg-4'></div>
			          <div class='col-lg-4'>";
			echo "<h4>Merci de votre message ! Nous y répondrons sous 48 heures.</h4>";
			echo "</div></div>";

	}else{
		//echo "<div class='container-set-contact-nous-text'>";
		echo "<div class='row'>
		          <div class='col-lg-4'></div>
		          <div class='col-lg-4'>";
		echo "<h4>Veuillez bien remplir le formulaire en entier, merci !</h4>";
		echo "</div></div>";
	}

echo footer();
echo '</body>
</html>';

?>
