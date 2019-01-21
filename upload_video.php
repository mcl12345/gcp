<?php

include("connection_bdd.php");
include("logo_search_menu.php");
include('footer.php');

function formulaire_upload() {
	echo "<br><br><br>";
    echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
          <div class='container'>
              <h5>La taille maximum autorisé d'un fichier est de 100Mo. Les types autorisés sont .ogg, .webm, .mp4, et .avi</h5><br />
              <form method='post' action='upload_video.php' enctype='multipart/form-data'>
                  <label class='label_formulaire' for='titre'>Titre : </label><input id='titre' name='titre' type='text' required /><br />
                  <label class='label_formulaire' for='description'>description : </label><input id='description' name='description' type='text' required /><br />
                  <input type='file' name='the_video' /> <br />
                  <label class='label_formulaire' for='mot_cle'>Mots-clé : </label><input type='texte' placeholder='Taper vos mots-clé séparés par un espace' style='width: 400px;' id='mot_cle' name ='mot_cle' required /><br /><br />
                  <input type='submit' name='envoyer' value='Envoyer' />
              </form>
          </div>
          </div>
        </div>";
}

if(isset($_POST['description']) && isset($_FILES['the_video']['name'])) {
  $mots_cle = $_POST["mot_cle"];

  $dossier = "upload_videos/";
  $fichier = basename($_FILES['the_video']['name']);
  $taille_maxi = 100000000; // 100 Mo
  $taille = filesize($_FILES['the_video']['tmp_name']); // Le fichier temporaire

  $extensions = array( '.ogg', '.wav', '.mp3', '.webm', '.mp4', '.avi');

  $extension = strrchr($_FILES['the_video']['name'], '.');

  $file_name = strstr($_FILES['the_video']['name'], '.', true);
  //Début des vérifications de sécurité...
  if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
  {
       $erreur = 'Vous devez uploader un fichier de type .webm';
  }
  if($taille > $taille_maxi) {
       $erreur = 'Le fichier est trop gros...';
  }
  if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
  {
       //On formate le nom du fichier ici...
       $fichier = strtr($fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
       $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
       if(move_uploaded_file($_FILES['the_video']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
       {
         $videoURL = "http://" . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "/", 2)) ."/". $dossier . $fichier;
         try {

           $type_media = 4;

           $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

           // set the PDO error mode to exception
           $stmt = $pdo->prepare("INSERT INTO video (titre, description, videoURL) VALUES (:titre, :description, :videoURL)");
           $stmt->bindParam(':titre', $_POST["titre"]);
           $stmt->bindParam(':description', $_POST["description"]);
           $stmt->bindParam(':videoURL', $videoURL);
           $stmt->execute();
           $id_media = $pdo->lastInsertId();

           $stmt_ = $pdo->prepare("INSERT INTO motcle (mots_cle, id_media, type_media) VALUES (:mots_cle, :id_media, :type_media)");
           $stmt_->bindParam(':mots_cle', $mots_cle);
           $stmt_->bindParam(':id_media', $id_media);
           $stmt_->bindParam(':type_media', $type_media);
           $stmt_->execute();

           $stmt = $pdo->prepare("INSERT INTO historique_video (id_video, id_user)  VALUES (:id_video, :id_user)");
           $stmt->bindParam(':id_video', $id_media);
           $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
           $stmt->execute();

            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                 <div class='col-lg-4'></div>
                 <div class='col-lg-4'>";
            echo 'Upload de la vidéo effectué avec succès !';
            echo '</div></div><br /><br /><br />';
            echo footer();
            echo '</body>
            </html>';
          } catch(PDOException $e) {
            echo $sql . "<br />" . $e->getMessage();
          }
       }
       else //Sinon (la fonction renvoie FALSE).
       {
            print_LOGO_FORMSEARCH_MENU($db_host, $db_name, $db_user, $db_password);
            echo 'Echec de l\'upload !';
            formulaire_upload($db_host, $db_name, $db_user, $db_password);
             echo '<br /><br /><br />';
            echo footer();
            echo '</body>
            </html>';
       }
  } else {
       print_LOGO_FORMSEARCH_MENU($db_host, $db_name, $db_user, $db_password);
      echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>";
       echo $erreur;
        echo '</div></div><br /><br /><br />';
            echo footer();
            echo '</body>
            </html>';
  }
} else {
    print_LOGO_FORMSEARCH_MENU($db_host, $db_name, $db_user, $db_password);

    formulaire_upload($db_host, $db_name, $db_user, $db_password);
     echo '<br /><br /><br />';
            echo footer();
            echo '</body>
            </html>';
}

 ?>
