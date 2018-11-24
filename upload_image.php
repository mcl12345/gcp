<?php


include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');


function formulaire_upload() {
    echo "<form method='post' action='upload_image.php' enctype='multipart/form-data'>
              <label for='description'>Description : </label><input id='description' name='description' type='text' required /><br />
              <input type='file' name='the_image' /> <br />
              <input type='submit' name='envoyer' value='Envoyer' />
    </form>";
}

if(isset($_FILES['the_image']['name'])) {
  $dossier = "upload_images/";
  $fichier = basename($_FILES['the_image']['name']);
  $taille_maxi = 10000000; // 10 Mo
  $taille = filesize($_FILES['the_image']['tmp_name']); // Le fichier temporaire

  $extensions = array( '.jpg', '.jpeg', 'png');

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

           $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

           // set the PDO error mode to exception
           $stmt = $pdo->prepare("INSERT INTO image (imageURL, description) VALUES (:imageURL, :description)");
           $stmt->bindParam(':imageURL', $imageURL);
           $stmt->bindParam(':description', $_POST["description"]);
           $stmt->execute();
           $id_image = $pdo->lastInsertId();

           $stmt = $pdo->prepare("INSERT INTO historique_image (id_image, id_user)  VALUES (:id_image, :id_user)");
           $stmt->bindParam(':id_image', $id_image);
           $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
           $stmt->execute();

            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                 <div class='col-lg-4'></div>
                 <div class='col-lg-4'>";
            echo 'Upload de l\'image effectué avec succès !';
            echo '</div></div></div>';
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
            echo '</div></div></div>';
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
       echo '</div></div></div>';
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
    echo '</div></div></div>';
    echo footer();
    echo '</body>
    </html>';
}

 ?>
