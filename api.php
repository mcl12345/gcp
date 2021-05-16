<?php

header('Content-Type: application/json');
include('connection_bdd.php');

//

if(isset($_GET['id_personnalite']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite WHERE id = ?");
    $stmt->execute(array($_GET['id_personnalite']));

    while ($row = $stmt->fetch()) {
            for($i = 0 ; $i<sizeof($row); $i++) {
                unset($row[$i]);
            }

            if($row["valide"] == 1) {
              echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            }
    }
}

if(isset($_GET['personnalite']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_personnalite");
    $stmt->execute();
    $personnalites = array();
    while ($row = $stmt->fetch()) {
      for($i = 0 ; $i<sizeof($row); $i++) {
        unset($row[$i]);
      }
      if($row["valide"] == 1) {
          $personnalites[] = $row;
      }
    }
    $personnalites_ = array("personnalites" => $personnalites);
    echo json_encode($personnalites_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['chapelle']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_chapelle");
    $stmt->execute();
    $chapelles = array();
    while ($row = $stmt->fetch()) {
      for($i = 0 ; $i<sizeof($row); $i++) {
        unset($row[$i]);
      }

      if($row["valide"] == 1) {
          $chapelles[] = $row;
       }
    }
    $chapelles_ = array("chapelles" => $chapelles);
    echo json_encode($chapelles_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_chapelle']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM patrimoine_basilique_chapelle WHERE id= ?");
    $stmt->execute(array($_GET["id_chapelle"]));
    while ($row = $stmt->fetch()) {
          for($i = 0 ; $i<sizeof($row); $i++) {
              unset($row[$i]);
          }
          if($row["valide"] == 1) {
            echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          }
    }
}

//------------------------------------------------------------ Groupe ?
if(isset($_GET['roi']))  {

    $rois = array();
    $merged_tab = array();
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM roi");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        $has_social_network = false;
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }

        // Va chercher le media concernant ce roi :
        $pdo_ = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $stmt_ = $pdo_->prepare("SELECT * FROM reseauxsociauxroi WHERE idRoi = ?");
        $stmt_->execute(array($row["idRoi"]));
        while ($ligne = $stmt_->fetch()) {
            $has_social_network = true;
            for($j = 0 ; $j<sizeof($row); $j++) {
                unset($ligne[$j]);
            }
            $merged_tab = array_merge($row, $ligne);
        }

        if(!$has_social_network) {
            $rois[] = $row;
        } else if ($has_social_network) {
            $rois[] = $merged_tab;
        }

    }
    $rois_ = array("rois" => $rois);
    echo json_encode($rois_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_roi']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM roi WHERE idRoi = ?");
    $stmt->execute(array($_GET["id_roi"]));
    $merged_tab = array();
    $rois = array();
    while ($row = $stmt->fetch()) {
        $has_social_network = false;
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }

        // Va chercher le media concernant ce roi :
        $stmt = $pdo->prepare("SELECT * FROM reseauxsociauxroi WHERE idRoi = ?");
        $stmt->execute(array($_GET["id_roi"]));
        while ($ligne = $stmt->fetch()) {
            $has_social_network = true;
            for($i = 0 ; $i<sizeof($row); $i++) {
                unset($ligne[$i]);
            }
            $merged_tab = array_merge($row, $ligne);
        }

        if(!$has_social_network) {
            $rois[] = $row;
        } else if ($has_social_network) {
            $rois[] = $merged_tab;
        }
    }

    echo json_encode($rois, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}



if(isset($_GET['commentaire']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM commentaires");
    $stmt->execute();
    $commentaires = array();
    while ($row = $stmt->fetch()) {
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }
        $commentaires[] = $row;
    }
    $commentaires_ = array("commentaires" => $commentaires);
    echo json_encode($commentaires_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_commentaire']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE idCommentaire = ?");
    $stmt->execute(array($_GET["id_commentaire"]));
    while ($row = $stmt->fetch()) {
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }
        echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}

if(isset($_GET['representation']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM representationsroi");
    $stmt->execute();
    $representations = array();
    while ($row = $stmt->fetch()) {
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }
        $representations[] = $row;
    }
    $representations_ = array("representations" => $representations);
    echo json_encode($representations_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_representation']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM representationsroi WHERE idRepresentationsRoi = ?");
    $stmt->execute(array($_GET["id_representation"]));
    while ($row = $stmt->fetch()) {
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }
        echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}

if(isset($_GET['associationrr']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM associationrr");
    $stmt->execute();
    $associationrr = array();
    while ($row = $stmt->fetch()) {
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }
        $associationrr[] = $row;
    }
    $associationrr_ = array("associationrr" => $associationrr);
    echo json_encode($associationrr_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_associationrr']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM associationrr WHERE id = ?");
    $stmt->execute(array($_GET["id_associationrr"]));
    while ($row = $stmt->fetch()) {
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }
        echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}
//------------------------------------------------------------ Groupe ?

if(isset($_GET['texte']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM texte");
    $stmt->execute();
    $textes = array();
    while ($row = $stmt->fetch()) {
      for($i = 0 ; $i<sizeof($row); $i++) {
        unset($row[$i]);
      }

      $motcle_empty = true;
      $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 1");
      $stmt_->execute(array($row["id"]));
      while ($ligne = $stmt_->fetch()) {
          $motcle_empty = false;
          $motscle .= " " . $ligne["mots_cle"];
      }
      if(!$motcle_empty) {
          $row["mots_cle"] = $motscle;
      }

      if($row["valide"] == 1) {
          $textes[] = $row;
       }
    }
    $textes_ = array("textes" => $textes);
    echo json_encode($textes_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_texte']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM texte WHERE id= ?");
    $stmt->execute(array($_GET["id_texte"]));
    while ($row = $stmt->fetch()) {
          for($i = 0 ; $i<sizeof($row); $i++) {
              unset($row[$i]);
          }

          $motcle_empty = true;
          $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 2");
          $stmt_->execute(array($row["id"]));
          while ($ligne = $stmt_->fetch()) {
              $motcle_empty = false;
              $motscle .= " " . $ligne["mots_cle"];
          }
          if(!$motcle_empty) {
              $row["mots_cle"] = $motscle;
          }

          if($row["valide"] == 1) {
            echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          }
    }
}

if(isset($_GET['image']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM image");
    $stmt->execute();
    $images = array();
    while ($row = $stmt->fetch()) {
        for($i = 0 ; $i<sizeof($row); $i++) {
            unset($row[$i]);
        }

        $motcle_empty = true;
        $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 2");
        $stmt_->execute(array($row["id"]));
        while ($ligne = $stmt_->fetch()) {
            $motcle_empty = false;
            $motscle .= " " . $ligne["mots_cle"];
        }
        if(!$motcle_empty) {
            $row["mots_cle"] = $motscle;
        }
        foreach($row as $key => $value) {
            if($key === "imageURL") {
                $row[$key] = "https://basiliquesaintdenis.ovh/basilique-saint-denis" . $row[$key];
            }
        }
        if($row["valide"] == 1) {
            $images[] = $row;
        }

    }
    $images_ = array("images" => $images);
    echo json_encode($images_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_image']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM image WHERE id= ?");
    $stmt->execute(array($_GET["id_image"]));
    while ($row = $stmt->fetch()) {
          for($i = 0 ; $i<sizeof($row); $i++) {
              unset($row[$i]);
          }

          $motcle_empty = true;
          $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 2");
          $stmt_->execute(array($row["id"]));
          while ($ligne = $stmt_->fetch()) {
              $motcle_empty = false;
              $motscle .= " " . $ligne["mots_cle"];
          }
          if(!$motcle_empty) {
              $row["mots_cle"] = $motscle;
          }

          if($row["valide"] == 1) {
            echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          }
    }
}

if(isset($_GET['video']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM video");
    $stmt->execute();
    $videos = array();
    while ($row = $stmt->fetch()) {
      for($i = 0 ; $i<sizeof($row); $i++) {
        unset($row[$i]);
      }

      $motcle_empty = true;
      $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media= 4");
      $stmt_->execute(array($row["id"]));
      while ($ligne = $stmt_->fetch()) {
          $motcle_empty = false;
          $motscle .= " " . $ligne["mots_cle"];
      }
      if(!$motcle_empty) {
          $row["mots_cle"] = $motscle;
      }

      if($row["valide"] == 1) {
          $videos[] = $row;
       }
    }
    $videos_ = array("videos" => $videos);
    echo json_encode($videos_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_video']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM video WHERE id= ?");
    $stmt->execute(array($_GET["id_video"]));
    while ($row = $stmt->fetch()) {
          for($i = 0 ; $i<sizeof($row); $i++) {
              unset($row[$i]);
          }

          $motcle_empty = true;
          $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 4");
          $stmt_->execute(array($row["id"]));
          while ($ligne = $stmt_->fetch()) {
              $motcle_empty = false;
              $motscle .= " " . $ligne["mots_cle"];
          }
          if(!$motcle_empty) {
              $row["mots_cle"] = $motscle;
          }

          if($row["valide"] == 1) {
              echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          }
    }
}

if(isset($_GET['audio']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM audio");
    $stmt->execute();
    $audio = array();
    while ($row = $stmt->fetch()) {
      for($i = 0 ; $i<sizeof($row); $i++) {
        unset($row[$i]);
      }

      $motcle_empty = true;
      $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 3");
      $stmt_->execute(array($row["id"]));
      while ($ligne = $stmt_->fetch()) {
          $motcle_empty = false;
          $motscle .= " " . $ligne["mots_cle"];
      }
      if(!$motcle_empty) {
          $row["mots_cle"] = $motscle;
      }

      if($row["valide"] == 1) {
          $audio[] = $row;
       }
    }
    $audio_ = array("audio" => $audio);
    echo json_encode($audio_, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

if(isset($_GET['id_audio']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM audio WHERE id= ?");
    $stmt->execute(array($_GET["id_audio"]));
    while ($row = $stmt->fetch()) {
          for($i = 0 ; $i<sizeof($row); $i++) {
              unset($row[$i]);
          }

          $motcle_empty = true;
          $stmt_ = $pdo->prepare("SELECT * FROM motcle WHERE id_media = ? AND type_media = 3");
          $stmt_->execute(array($row["id"]));
          while ($ligne = $stmt_->fetch()) {
              $motcle_empty = false;
              $motscle .= " " . $ligne["mots_cle"];
          }
          if(!$motcle_empty) {
              $row["mots_cle"] = $motscle;
          }

          if($row["valide"] == 1) {
              echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          }
    }
}

/**
* API
*/


?>
