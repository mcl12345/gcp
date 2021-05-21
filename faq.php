<?php

include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

echo '<header>
	<h1>FAQ de la Plateforme</h1>
</header>
<section class="cd-faq">
	<ul class="cd-faq-categories">
		<li><a class="selected" href="#basics">Basics</a></li>
		<li><a href="#mobile">Mobile</a></li>
		<li><a href="#account">Account</a></li>

	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
		<ul id="basics" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Basics</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment puis-je m’inscrire ?</a>
				<div class="cd-faq-content">
					<p>Cliquez sur le lien « Enregistrement » en haut à droite du site.</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment uploader un texte, une image , de l\'audio ou de la vidéo sur la plateforme ?</a>
				<div class="cd-faq-content">
					<p>Il suffit d\'aller sur "Téléversement" du média en question en haut à droite, puis après il faut le valider pour qu\'il soit à la vue de tous. S\'il n\'y a pas de validation du média, alors il est considéré comme invisible, à l\'exception de l\'upload de la catégorie "les rois".</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment lire un texte, une image , de l\'audio ou de la vidéo sur la plateforme </a>
				<div class="cd-faq-content">
					<p>Il suffit d\'aller sur les onglets de visionnage du média en question en haut à gauche de l\'écran.</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment puis-je faire un document multimédia ? </a>
				<div class="cd-faq-content">
					<p>Il suffit d\'aller sur l\'onglet "Documents", créer un document et ajouter des textes validés, des images validées, de l\'audio validé ou de la vidéo validée ou d\'aller sur un document dejà existant.</p>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->

		<ul id="mobile" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Mobile</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment télécharger des fichiers depuis mon téléphone ou ma tablette ?</a>
				<div class="cd-faq-content">
					<p>Notre site étant responsive, vous pouvez directement télécharger vos fichiers via votre tablette ou votre smartphone ( en format ogg ( pour l\'audio ) ou webm ( pour les vidéos ) ou jpg ( pour les images ) ). Il vous suffit de cliquer sur le bouton « télécharger ». </p>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->

		<ul id="account" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Account</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Comment puis-je supprimer mon compte ?</a>
				<div class="cd-faq-content">
					<p>Connectez-vous à votre compte puis, cliquez sur l’onglet « profil ». Ensuite, cliquez sur « Supprimer mon compte ».</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment modifier les paramètres de mon compte ?</a>
				<div class="cd-faq-content">
					<p>Connectez-vous à votre compte et cliquez sur « profil ». Vous pourrez ainsi modifier toutes vos informations personnelles. </p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">J’ai oublié mon mot de passe. Comment puis-je accéder à mon compte ?</a>
				<div class="cd-faq-content">
					<p>Il vous faut recréer un compte.</p>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->


		<ul id="delivery" class="cd-faq-group">
		</ul> <!-- cd-faq-group -->
	</div> <!-- cd-faq-items -->
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->';

echo footer();

echo '</body>
</html>';

?>
