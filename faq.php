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
				<a class="cd-faq-trigger" href="#0">Comment puis-je changer de mot de passe ?</a>
				<div class="cd-faq-content">
					<p>Accédez à votre compte. Pour cela, vous devrez peut-être vous connecter.
Sous "Connexion et sécurité", sélectionnez « Se connecter ». Ensuite, sélectionnez « mot de passe ».
Saisissez votre nouveau mot de passe puis, sélectionnez « Modifier le mot de passe ».</p>
				</div> <!-- cd-faq-content -->
			</li>

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
					<p>Pour donner votre avis sur le site et sur le contenu qui s’y trouve, vous avez à votre disposition un système de notation par étoiles. Il vous suffit de cliquer sur le nombre d’étoiles qui vous convient. Le nombre maximum d’étoiles est de 5, plus vous en choisissez, plus la note est élevée. Vous pouvez également laisser un commentaire dans l’endroit prévu à cet effet.</p>
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
