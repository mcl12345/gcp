<?php

include("bibliotheque8.inc.php");

//$sourceHTML = "ccm/lemonde.html";

//indexer($sourceHTML);

/*if(isset($_POST["titre"]) && isset($_POST["texte_upload"])) {
    if(!isset($_POST["mot_cle"])) {
        $_POST["mot_cle"] = "";
    }
    indexer($_POST["titre"], $_POST["texte_upload"], $_POST["mot_cle"]);
}*/


function indexer($titre, $texte) {
    $separateurs = "\",.'/<>()’!?;:|&\t\"\n\r\'_-=+@/*%{}[]#0123456789 "; //»«�‰–¶¸Ž

    // Récupére le titre et les motscle et la description
    $chaine_head = entitiesHTML2ASCII(strtolower($titre));
    $tab_head    = explode_bis($chaine_head, $separateurs);
    $tab_mots_occurrences_head = array_count_values($tab_head);

    // Affichage du retour de la fonction - On récupère le body
    $texte_body = entitiesHTML2ASCII($texte);
    //tokenisation des données du body
    $tab_mots_body = explode_bis($texte_body, $separateurs);
    //print_r($tab_mots_body);
    // liste de mots du body avec leurs nombres d'occurrences.
    $tab_mots_poids_body = array_count_values($tab_mots_body);

    // ---------------------------------------------

    $coefficient_head = 1.5;
    $tab_mots_poids_head = occurrences2poids($tab_mots_occurrences_head , $coefficient_head);

    // Fusion des deux tableaux head avec body
    $tab_mots_poids = fusion_deux_tableaux($tab_mots_poids_head, $tab_mots_poids_body);

    // Gestion des mots-clés
    // Faire avec in_array() après le explode_bis()
    foreach ($tab_mots_poids as $mot => $poids) {
        foreach (file("mots-vides.txt") as $key => $value) {
            //echo $value . "<br />";
            if(trim($value) == $mot) {
              unset($tab_mots_poids[$mot]);
            }
        }
    }

    // Affichage
    //print_tab($tab_mots_poids);
    echo "<br /><br />";
    // -----------------------------------------
    // Insertion dans la bdd
    //------------------------------------------

    $db_host = "localhost";
    $db_user = "newuser";
    $db_password = "password";
    $db_name = "basilique";
    $connexion = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    // Pour enlever les caractères 'quote'
    $titre = mysqli_real_escape_string($connexion, $titre);
    $texte = mysqli_real_escape_string($connexion, $texte);

    $id_document = 0;

    // Vérification si ce document existe dans la bdd :
    $sql_select = "SELECT * FROM document_texte WHERE titre = '" . $titre . "'";
    //echo "<br /><br /> sql_select : " . $sql_select . "<br />";     // Debug

    $resultat_select = mysqli_query($connexion, $sql_select);

    if(mysqli_num_rows($resultat_select)) {
        //echo "<br />" . $titre . " est déjà enregistré<br />";
        while($row = $resultat_select->fetch_assoc()) {
            $id_document = $row["id"];
        }
    } else {
        // Insertion du document
        $sql = "INSERT INTO document_texte (titre, texte) VALUES ('$titre', '$texte')";
        $resultat = mysqli_query($connexion, $sql);
        $id_document = mysqli_insert_id($connexion);
        //if($resultat) echo "<br />", $sql , "<br /><br />"; // Debug
    }

    $nombre_insertion_mot = 0;
    $nombre_insertion_mot_deja_inserer = 0;
    $nombre_insertion_mot_document = 0;

    // Insertion des mots et mot_document (id_mot, id_document, poids) :
    foreach ($tab_mots_poids as $mot => $poids)
    {
        $sql_select = "SELECT * FROM mot_texte WHERE mot = '" . $mot . "'";

        $resultat_select = mysqli_query($connexion, $sql_select);

        if(mysqli_num_rows($resultat_select))
        {
            $nombre_insertion_mot_deja_inserer++;
            //if($nombre_insertion_mot_deja_inserer < 10) echo $mot . " est déjà enregistré<br />"; // Debug
            $id_mot = mysqli_fetch_row($resultat_select)[0];
        } else {
            $nombre_insertion_mot++;
            $sql1 = "INSERT INTO mot_texte (mot) VALUES ('$mot')";
            $resultat1 = mysqli_query($connexion, $sql1);
            $id_mot = mysqli_insert_id($connexion);
            //if($resultat1 && $nombre_insertion_mot < 10) echo $sql1 , "<br />"; // Debug
        }
        // Insertion dans la table mot_document
        if($id_document != 0) {
            $nombre_insertion_mot_document++;
            $sql2 = "INSERT INTO mot_document_texte (id_mot_texte, id_document_texte, poids) VALUES ($id_mot, $id_document, $poids)";
            $resultat = mysqli_query($connexion, $sql2);
            //if($resultat && $nombre_insertion_mot_document < 10) echo $sql2 , "<br />"; // Debug
        }
    }

    // Debug
    //echo "<br /><br />Nombre d'enregistrement dans la table <strong>mot_texte</strong> : " . $nombre_insertion_mot . "<br />";
    //echo "Nombre d'enregistrement dans la table <strong>mot_document_texte</strong> : " . $nombre_insertion_mot_document . "<br />";
    //echo "Nombre d'enregistrement déjà inséré dans la table <strong>mot_texte</strong> : " . $nombre_insertion_mot_deja_inserer . "<br />";

    mysqli_close($connexion);

}
?>
