<?php

include("connection_bdd.php");
include("logo_search_menu.php");
include('footer.php');

function formulaire_upload() {
    echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>
          <div class='container'>
              <form method='post' action='upload_video.php' enctype='multipart/form-data'>
                  <label for='description'>description : </label><input id='description' name='description' type='text' required /><br />
                  <input type='file' name='the_music' /> <br />
                  <label for='titre'>Mots-clé : </label><input type='texte' placeholder='Taper vos mot_cles séparé par un espace ( max 3 )' style='width: 400px;' name ='mot_cle' required /><br /><br />
                  <input type='submit' name='envoyer' value='Envoyer' />
              </form>
          </div>
          </div>
        </div>";
}

if(isset($_POST['description']) && isset($_FILES['the_music']['name'])) {
  $mots_cle = explode(" ", $_POST["mot_cle"]);

  $dossier = "upload_videos/";
  $fichier = basename($_FILES['the_music']['name']);
  $taille_maxi = 100000000; // 100 Mo
  $taille = filesize($_FILES['the_music']['tmp_name']); // Le fichier temporaire

  $extensions = array( '.ogg', '.wav', '.mp3', '.webm');

  $extension = strrchr($_FILES['the_music']['name'], '.');

  $file_name = strstr($_FILES['the_music']['name'], '.', true);
  //Début des vérifications de sécurité...
  if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
  {
       $erreur = 'Vous devez uploader un fichier de type .wav, .mp3 ou .webm';
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
       if(move_uploaded_file($_FILES['the_music']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
       {
         $videoURL = "http://" . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "/", 2)) ."/". $dossier . $fichier;
         try {

           $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

           // set the PDO error mode to exception
           $stmt = $pdo->prepare("INSERT INTO video (videoURL, description, mot_cle1, mot_cle2, mot_cle3) VALUES (:videoURL, :description, :mot_cle1, :mot_cle2, :mot_cle3)");
           $stmt->bindParam(':videoURL', $videoURL);
           $stmt->bindParam(':description', $_POST["description"]);
           $stmt->bindParam(':mot_cle1', $mots_cle[0]);
           $stmt->bindParam(':mot_cle2', $mots_cle[1]);
           $stmt->bindParam(':mot_cle3', $mots_cle[2]);
           $stmt->execute();
           $id_video = $pdo->lastInsertId();

           $stmt = $pdo->prepare("INSERT INTO historique_video (id_video, id_user)  VALUES (:id_video, :id_user)");
           $stmt->bindParam(':id_video', $id_video);
           $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
           $stmt->execute();

            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                 <div class='col-lg-4'></div>
                 <div class='col-lg-4'>";
            echo 'Upload de l\'image effectué avec succès !';
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
              echo "<div class='row'>
                 <div class='col-lg-4'></div>
                 <div class='col-lg-4'>";
            echo 'Echec de l\'upload !';
            formulaire_upload($db_host, $db_name, $db_user, $db_password);
             echo '</div></div><br /><br /><br />';
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
      echo "<div class='row'>
           <div class='col-lg-4'></div>
            <div class='col-lg-4'>";
    formulaire_upload($db_host, $db_name, $db_user, $db_password);
     echo '</div></div><br /><br /><br />';
            echo footer();
            echo '</body>
            </html>';
}

 ?>
