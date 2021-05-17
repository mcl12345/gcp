<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

echo "<div class='row'>
      <div class='col-lg-4'></div>
      <div class='col-lg-4'>
          <div class='container'>";

echo "L'api est fonctionnelle si on tape <a target='_blank' href='https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?personnalite=true'>https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?personnalite=true</a><br />
on a toutes les personnalités<br />
si on tape <a target='_blank' href='https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?id_personnalite=1'>https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?id_personnalite=1</a><br />
on a une personnalité par son id<br /><br /><br />

On peut faire pareil avec les rois si on tape <a target='_blank' href='https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?roi=true'>https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?roi=true</a><br />
et <a target='_blank' href='https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?id_roi=1'>https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?id_roi=1</a><br /><br /><br />

si on tape <a target='_blank' href='https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?chapelle=true'>https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?chapelle=true</a><br />
on a toutes les chapelles.<br /><br />

si on tape <a target='_blank' href='https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?id_chapelle=5'>https://basiliquesaintdenis.ovh/basilique-saint-denis/api.php?id_chapelle=5</a><br />
on a la chapelle par son id<br /><br />

L'API est aussi disponible pour les textes, les images, les sons, et les vidéos.<br /><br />

A utiliser avec Firefox qui permet de présenter les données JSON de façon indenté.<br /><br />

Voir pour plus d'informations : https://github.com/mcl12345/gcp/blob/master/README.md<br />";
echo "</div></div></div>";
echo footer();
echo "</body></html>";
?>
