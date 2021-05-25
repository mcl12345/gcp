<?php

include('logo_search_menu.php');
include('footer.php');

if ($_SESSION["the_username"] != "" || !is_empty($_SESSION["the_id"])) {
    unset($_SESSION["the_username"]);
    unset($_SESSION["the_email"]);
    unset($_SESSION["the_role"]);
    unset($_SESSION["the_id"]);
    unset($_SESSION["the_password_encoded"]);
    /*setcookie("the_username", "", time()-3600); // Mettre une date antérieure le force à se supprimer au prochain chargement de page.
    setcookie("the_email", "", time()-3600);
    setcookie("the_role", "", time()-3600);
    setcookie("the_id", "", time()-3600);
    setcookie("the_password_encoded", "", time()-3600);*/

    print_LOGO_FORMSEARCH_MENU();
	echo "<br><br><br>";
    echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>";
    echo "<h3>Vous vous êtes déconnecté !</h3>";
    echo '</div></div></div><br /><br/>';

    echo footer();

    echo '</body>
    </html>';
}
/* else {
  print_LOGO_FORMSEARCH_MENU();
  echo "<br><br><br>";
  echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
	echo "<h3>";
    echo "Vous êtes déconnecté ! " . $_SESSION['the_username'];
	echo "</h3>";
    echo '</div></div></div><br /><br/>';

    echo footer();

    echo '</body>
    </html>';
}*/


?>
