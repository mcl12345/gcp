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
		<li><a href="#privacy">Privacy</a></li>

	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
		<ul id="basics" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Basics</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment puis-je m’inscrire ?</a>
				<div class="cd-faq-content">
					<p>Cliquez sur l’onglet « connexion » en haut à droite du site. Vous aurez ensuite le choix entre deux options.  « J’ai déjà un compte » et « nouvel utilisateur ». Sélectionnez « nouvel utilisateur ». Remplissez le formulaire qui apparaitra sur votre écran et suivez les étapes.</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Puis-je supprimer un post ?</a>
				<div class="cd-faq-content">
					<p>Pour supprimer un post, vous devez cliquer sur l’onglet « supprimer » à droite de votre post. Après quoi une fenêtre apparaîtra vous indiquant que votre demande de suppression a été envoyée à l’administrateur du site. Votre post sera supprimé dans les 24H maximum après votre demande.</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment fonctionnent les avis ?</a>
				<div class="cd-faq-content">
					<p>Vous pouvez laisser un commentaire dans l’endroit prévu à cet effet sur les rois uniquement, en cochant le bouton "radio" et en faisant "Explorer".</p>
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
					<p>Il suffit d\'aller sur les onglets de visionnage du média en question en haut à gauche de l\'écran et au milieu.</p>
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
					<p>Notre site étant responsive, vous pouvez directement télécharger vos fichiers via votre tablette ou votre smartphone ( en format ogg ou webm ). Il vous suffit de cliquer sur le bouton « télécharger ». </p>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->

		<ul id="account" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Account</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Comment puis-je supprimer mon compte ?</a>
				<div class="cd-faq-content">
					<p>Connectez-vous à votre compte puis, cliquez sur l’onglet « paramètres ». Ensuite, cliquez sur « sécurité » et « supprimer mon compte ». Suivez les étapes.</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Comment modifier les paramètres de mon compte ?</a>
				<div class="cd-faq-content">
					<p>Connectez-vous à votre compte et cliquez sur « paramètres personnels ». Vous pourrez ainsi modifier toutes vos informations personnelles et autres. </p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">J’ai oublié mon mot de passe. Comment puis-je accéder à mon compte ?</a>
				<div class="cd-faq-content">
					<p>Accédez à la page de connexion et cliquez sur « je n’arrive pas à me connecter ».<br />
					Entrez votre adresse email et cliquez sur « suivant ». Sélectionnez ensuite un mode de vérification et cliquez sur « suivant ».<br />
					Laissez-vous guider.</p>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->

		<ul id="privacy" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Privacy</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Comment puis-je accéder aux données de mon compte ?</a>
				<div class="cd-faq-content">
					<p>Vous pouvez accéder aux données de votre compte à tout moment et nous assurons la sécurité de celles-ci. Aucune de vos informations personnelles ne seront réutilisées à des fins commerciales, personnelles ou autres.</p>
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
