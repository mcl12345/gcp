<?php


include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');


function formulaire_upload() {
	echo "<br><br><br>";
    echo "<form method='post' action='upload_image.php' enctype='multipart/form-data'>
              <label class='label_formulaire' for='titre'>Titre : </label><input id='titre' name='titre' type='text' required /><br />
              <label class='label_formulaire' for='description'>Description : </label><input id='description' name='description' type='text' required /><br />
              <input type='file' name='the_image' /> <br />
              <label class='label_formulaire' for='titre'>Mots-clé : </label><input type='texte' placeholder='Taper vos mot-clés séparé par une virgule' style='width: 600px;' name ='mot_cle' required /><br /><br />
              <input type='submit' name='envoyer' value='Envoyer' />
    </form>";
}

if(isset($_FILES['the_image']['name'])) {

  $mots_cle = $_POST["mot_cle"];

  $dossier = "upload_images/";
  $fichier = basename($_FILES['the_image']['name']);
  $taille_maxi = 10000000; // 10 Mo
  $taille = filesize($_FILES['the_image']['tmp_name']); // Le fichier temporaire

  $extensions = array( '.jpg', '.jpeg', '.png');

  $extension = strrchr($_FILES['the_image']['name'], '.');
  //Début des vérifications de sécurité...
  if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
  {
       $erreur = 'Vous devez uploader un fichier de type .jpg, .jpeg ou .png';
  }
  if($taille > $taille_maxi) {
       $erreur = 'Le fichier image est trop gros...';
  }
  if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
  {
       //On formate le nom du fichier ici...
       $fichier = strtr($fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
       $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
       if(move_uploaded_file($_FILES['the_image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
       {
         $imageURL = "http://" . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "/", 2)) ."/". $dossier . $fichier;
         try {
           $type_media = 2; // texte 1, image : 2, audio : 3, video : 4

           $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

           // set the PDO error mode to exception
           $stmt = $pdo->prepare("INSERT INTO image (titre, description, imageURL) VALUES (:titre, :description, :imageURL)");
           $stmt->bindParam(':titre', $_POST["titre"]);
           $stmt->bindParam(':description', $_POST["description"]);
           $stmt->bindParam(':imageURL', $imageURL);
           $stmt->execute();
           $id_media = $pdo->lastInsertId();

           $stmt_ = $pdo->prepare("INSERT INTO motcle (mots_cle, id_media, type_media) VALUES (:mots_cle, :id_media, :type_media)");
           $stmt_->bindParam(':mots_cle', $mots_cle);
           $stmt_->bindParam(':id_media', $id_media);
           $stmt_->bindParam(':type_media', $type_media);
           $stmt_->execute();

           $stmt = $pdo->prepare("INSERT INTO historique_image (id_image, id_user)  VALUES (:id_image, :id_user)");
           $stmt->bindParam(':id_image', $id_media);
           $stmt->bindParam(':id_user', $_SESSION["the_id"]);
           $stmt->execute();

            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                 <div class='col-lg-4'></div>
                 <div class='col-lg-4'>";
            echo 'Upload de l\'image effectué avec succès !<br />';
            echo "<a href='image_a_valider.php'>Validation de votre contenu image ici !</a>";
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
            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                 <div class='col-lg-4'></div>
                 <div class='col-lg-4'>";
            echo 'Echec de l\'upload !';
            echo '</div></div><br /><br /><br />';
            echo footer();
            echo '</body>
            </html>';
       }

  }
  else
  {
      print_LOGO_FORMSEARCH_MENU();
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

    print_LOGO_FORMSEARCH_MENU();
    echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>";
    formulaire_upload();
    echo '</div></div><br /><br /><br />';
    echo footer();
    echo '</body>
    </html>';
}

 ?>
