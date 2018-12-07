<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

echo "L'api est fonctionnelle si on tape http://213.32.90.43/basilique-saint-denis/api.php?personnalite=true
on a toutes les personnalités
si on tape http://213.32.90.43/basilique-saint-denis/api.php?id_personnalite=1
on a une personnalité par son id


si on tape http://213.32.90.43/basilique-saint-denis/api.php?chapelle=true
on a toutes les chapelles.

si on tape http://213.32.90.43/basilique-saint-denis/api.php?id_chapelle=5
on a la chapelle par son id

L'API est aussi disponible pour les textes, les images, les sons, et les vidéos.

A utiliser avec Firefox qui permet de présenter les données JSON de façon indenter.";

echo footer();
echo "</body></html>";
?>
