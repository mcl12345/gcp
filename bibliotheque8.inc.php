<?php

// Tokenisation - Fonction de filtrage : Changement de la fonction avec la ligne $tab[] = strtolower(trim($tok));
function explode_bis($source_, $separateurs_) {
  $tab = array();
  $tok = strtok ( $source_, $separateurs_);

  // Caractère causant un caractère invalide : �
  $separateur1 = "«";
  $separateur2 = "»";
  $separateur3 = "nbsp;";
  $separateur4 = "‰";
  $separateur5 = "–";
  $separateur6 = "¶";
  $separateur7 = "¸";
  $separateur8 = "Ž";


  while ( $tok !== false ) {
    if(strlen($tok) > 2) {
        if(stripos($tok, $separateur1) !== false && stripos($tok, $separateur2) !== false ) {
            // On n'enregistre pas
            //echo "double : -", substr($tok, stripos($tok, $separateur1)+4, stripos($tok, $separateur2)-6) , "-<br/>";
            //$tab[] = strtolower(substr($tok, stripos($tok, $separateur1)+4, stripos($tok, $separateur2)-6));
        } else if(stripos($tok, $separateur1) !== false) {
            // On n'enregistre pas
            //echo "first : -" , substr($tok, stripos($tok, $separateur1)+4, strlen($tok)-stripos($tok, $separateur1)) , "-<br/>";
            //$tab[] = strtolower(substr($tok, stripos($tok, $separateur1)+4, strlen($tok)-stripos($tok, $separateur1)));
        } else if(stripos($tok, $separateur2) !== false) {
            // On n'enregistre pas
            //echo "second : -" , substr($tok, 0, stripos($tok, $separateur2)-2) , "-<br/>";
            //$tab[] = strtolower(substr($tok, 0, stripos($tok, $separateur2)-2));
        } else if(mb_stripos($tok, $separateur3) !== false) {
            // On n'enregistre pas _ NOK
            //echo "&nbsp; : -" , $tok , "-<br/>";
        } else if(stripos($tok, $separateur4) !== false) {
            // On n'enregistre pas
        } else if(stripos($tok, $separateur5) !== false) {
            // On n'enregistre pas
        } else if(stripos($tok, $separateur6) !== false) {
            // On n'enregistre pas
        } else if(stripos($tok, $separateur7) !== false) {
            // On n'enregistre pas
        } else if(stripos($tok, $separateur8) !== false) {
            // On n'enregistre pas
        }
        // On enregistre :
        else {
            $tab[] = strtolower(trim($tok));
        }
    }
    $tok = strtok($separateurs_);
  }
  return $tab;
}

// Fonction d'affichage d'un tableau associatif :
function print_tab($tab_mots_) {
    foreach ($tab_mots_ as $key => $value) {
      echo $key . " : " . $value . "<br />";
    }
}

// Extraction des balises meta HTML - Changement avec strtolower
function get_meta_keywords($source_) {
    // Les metas keywords et description
    $tableau = get_meta_tags($source_);

    // Encode l'iso-8859-1 en UTF-8
    if(!mb_check_encoding($tableau["keywords"], 'UTF-8')
    || !($tableau["keywords"] === mb_convert_encoding(mb_convert_encoding($tableau["keywords"], 'UTF-32', 'UTF-8' ), 'UTF-8', 'UTF-32'))) {
        $tableau["keywords"] = mb_convert_encoding($tableau["keywords"], 'UTF-8');
    }

    // TODO Faire la verification de si keywords est null return chaine vide
    return strtolower($tableau["keywords"]);
}

// Extraction des balises meta HTML - Changement avec strtolower
function get_meta_description($source_) {
    // Les metas keywords et description
    $tableau = get_meta_tags($source_);

    // Encode l'iso-8859-1 en UTF-8
    if(!mb_check_encoding($tableau["description"], 'UTF-8')
    || !($tableau["description"] === mb_convert_encoding(mb_convert_encoding($tableau["description"], 'UTF-32', 'UTF-8' ), 'UTF-8', 'UTF-32'))) {
      $tableau["description"] = mb_convert_encoding($tableau["description"], 'UTF-8');
    }

    // TODO Faire la verification de si description est null return chaine vide
    return strtolower($tableau["description"]);
}

// Extraction d'un titre d'un HTML - Changement avec strtolower
// Le s c'est pour space , on ignore le retour à la ligne
// le i c'est pour insensible à la casse , on prend aussi les majuscules : <TITLE>
function get_title($sourceHTML_) {
  $chaine = implode(file($sourceHTML_), " ");

  // Encode l'iso-8859-1 en UTF-8
  if(!mb_check_encoding($chaine, 'UTF-8')
  || !($chaine === mb_convert_encoding(mb_convert_encoding($chaine, 'UTF-32', 'UTF-8' ), 'UTF-8', 'UTF-32'))) {
    $chaine = mb_convert_encoding($chaine, 'UTF-8');
  }

  $modele = "/<title>(.*)<\/title>/si";

  preg_match($modele, $chaine, $le_titre);
  // Retourne le contenu et non le modèle
  return strtolower($le_titre[1]);
}

// Récupération du <body> d'un fichier HTML - Changement de la ligne: $body_contenu = strtolower($le_body[1]); avec strtolower
function get_body($_sourceHTML_) {
    // Découpe le fichier HTML en Chaine de mots espacés une seule fois
    // Il est possible de faire file(http://)
    $chaine = implode(file($_sourceHTML_), " ");

    // Encode l'iso-8859-1 en UTF-8
    if(!mb_check_encoding($chaine, 'UTF-8')
    || !($chaine === mb_convert_encoding(mb_convert_encoding($chaine, 'UTF-32', 'UTF-8' ), 'UTF-8', 'UTF-32'))) {
      $chaine = mb_convert_encoding($chaine, 'UTF-8');
    }

    // Récupération du body
    $modele = '/<body[^>]*>(.*)<\/body>/is';
    preg_match($modele, $chaine, $le_body);

    // Récupération des items texte
    $body_contenu = $le_body[1];

    // Supprime les balises JavaScript
    $body_sans_script = strip_javascript($body_contenu);

    // Enlève toutes les balises
    return strip_tags_bis($body_sans_script);
}

function strip_tags_bis($contenu) {
  $modele_balises = '/<[^>]*>/';
  $contenu_sans_balise = preg_replace($modele_balises, ' ', $contenu);
  return $contenu_sans_balise;
}

function strip_javascript($contenu) {
  $modele_balises_scripts = '/<script[^>]*?>.*?<\/script>/is';
  $contenu_sans_script_javascript = preg_replace($modele_balises_scripts, '', $contenu);
  return $contenu_sans_script_javascript;
}

function occurrences2poids($tab, $coefficient) {
  foreach ($tab as $key => $value) {
      $tab[$key] *= $coefficient;
  }
  return $tab;
}

function fusion_deux_tableaux($tab_head, $tab_body) {
    foreach ($tab_head as $mot => $occurrence) {
        if(array_key_exists($mot, $tab_body)) {
            $tab_body[$mot] += $occurrence;
        } else {
            $tab_body[$mot] = $occurrence;
        }
    }
    return $tab_body;
}

// Traduction des caractères HTML en ASCII
function entitiesHTML2ASCII($chaine){
    //HTML_ENTITIES: tous les caractères éligibles en entités HTML.

    // retourne la table de traduction des entités utilisée en interne par la htmlentities():
    $table_caracts_html = get_html_translation_table(HTML_ENTITIES)  ;
    // retourne un tableau dont les clés sont les valeurs du précédent $table_caracts_html, et les valeurs sont les clés.
    $tableau_html_caracts =  array_flip ( $table_caracts_html ) ;
    // retourne une chaine de caractères après avoir remplacé les éléments/clés par les éléments/valeurs  du tableau associatif de paires $tableau_html_caracts dans la chaîne $chaine.
    $chaine  =  strtr ($chaine,   $tableau_html_caracts );
    return $chaine;
}

?>
