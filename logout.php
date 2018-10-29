<?php

if (isset($_COOKIE["the_username"])) {
    unset($_COOKIE["the_username"]); // cela ne semble pas fonctionner
    unset($_COOKIE["the_email"]);
    unset($_COOKIE["the_role"]);
    setcookie("the_username", "", time()-3600); // Mettre une date antérieure le force à se supprimer au prochain chargement de page.
    setcookie("the_email", "", time()-3600);
    setcookie("the_role", "", time()-3600);

    echo "Vous vous êtes déconnecté !";
} else {
    echo "Vous êtes déconnecté ! " . $_COOKIE['the_username'];
}


?>
