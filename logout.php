<?php

include('logo_search_menu.php');
include('footer.php');

if (isset($_COOKIE["the_username"]) || isset($_COOKIE["the_id"])) {
    unset($_COOKIE["the_username"]); // cela ne semble pas fonctionner
    unset($_COOKIE["the_email"]);
    unset($_COOKIE["the_role"]);
    unset($_COOKIE["the_id"]);
    unset($_COOKIE["the_password_encoded"]);
    setcookie("the_username", "", time()-3600); // Mettre une date antérieure le force à se supprimer au prochain chargement de page.
    setcookie("the_email", "", time()-3600);
    setcookie("the_role", "", time()-3600);
    setcookie("the_id", "", time()-3600);
    setcookie("the_password_encoded", "", time()-3600);

    print_LOGO_FORMSEARCH_MENU();
    echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>";
    echo "Vous vous êtes déconnecté !";
    echo '</div></div></div><br /><br/>';

    echo footer();

    echo '</body>
    </html>';
} else {
  print_LOGO_FORMSEARCH_MENU();
  echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
    echo "Vous êtes déconnecté ! " . $_COOKIE['the_username'];
    echo '</div></div></div><br /><br/>';

    echo footer();

    echo '</body>
    </html>';
}


?>
