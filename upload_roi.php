<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');


function formulaire_upload() {
    echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>
                <div class='container'>";

    if(isset($_COOKIE["the_id"])) {

      echo "<form action='upload_roi.php' method='post' enctype='multipart/form-data'>
              <label class='label_formulaire' for='nom'>Nom : </label><input type='text' id='nom' name='nom' placeholder='Louis XIV' required /><br />
              <label class='label_formulaire' for='duree_reigne'>Durée du reigne : </label><input type='text' id='duree_reigne' placeholder='40' name='duree_reigne' required /><br />
              <label class='label_formulaire' for='dynastie'>Dynastie : </label><input type='text' id='dynastie' name='dynastie' placeholder='Valois' required /><br />
              <label class='label_formulaire' for='description'>Description : </label><input type='text' id='description' name='description' placeholder='roi de France' required /><br />
              <label class='label_formulaire' for='the_image'>Image : </label><input type='file' id='the_image' name='the_image' /> <br />
              <input type='submit' value='Envoyer' />
            </form>";
    }
    echo "</div></div></div><br /><br />";
}

if( isset($_POST["nom"]) && isset($_POST["description"]) && isset($_POST["duree_reigne"]) && isset($_POST["dynastie"])) {
  $dossier = "upload_images/";
  $fichier = basename($_FILES['the_image']['name']);
  $taille_maxi = 100000000; // 100 Mo
  $taille = filesize($_FILES['the_image']['tmp_name']); // Le fichier temporaire

  $extensions = array( '.jpeg', '.jpg', '.png');

  $extension = strrchr($_FILES['the_image']['name'], '.');

  echo "extension : " . $extension;

  $file_name = strstr($_FILES['the_image']['name'], '.', true);
  //Début des vérifications de sécurité...
  if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
  {
       $erreur = 'Vous devez uploader un fichier de type .jpg, .jpeg ou .png';
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
     if(move_uploaded_file($_FILES['the_image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
       $imageURL = "http://" . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "/", 2)) ."/". $dossier . $fichier;
          try {
           $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
           // set the PDO error mode to exception
           $stmt = $pdo->prepare("INSERT INTO roi (nomRoi, dureeReigne, dynastie, description, photo)  VALUES (:nomRoi, :dureeReigne, :dynastie, :description, :photo)");
           $stmt->bindParam(':nomRoi', $_POST["nom"]);
           $stmt->bindParam(':dureeReigne', $_POST["duree_reigne"]);
           $stmt->bindParam(':dynastie', $_POST["dynastie"]);
           $stmt->bindParam(':description', $_POST["description"]);
           $stmt->bindParam(':photo', $imageURL);
           $stmt->execute();
           $id_roi = $pdo->lastInsertId();

           echo "id roi : " . $id_roi;


           print_LOGO_FORMSEARCH_MENU();
           echo "<div class='row'>
                   <div class='col-lg-4'></div>
                   <div class='col-lg-4'>
                       <div class='container'>";
           echo "<br /><strong>L'enregistrement de ".$_POST["nom"]." a été effectué avec succès.</strong>";
           echo "</div></div></div><br /><br />";
           echo footer();
           echo   '</body>
                </html>';
         } catch(PDOException $e) {
           echo $sql . "<br />" . $e->getMessage();
         }
       } else {//Sinon (la fonction renvoie FALSE).
          print_LOGO_FORMSEARCH_MENU();
          echo '<strong>Echec de l\'upload !</strong>';
          formulaire_upload();
          echo footer();
          echo   '</body>
               </html>';
         }
       } else {
           print_LOGO_FORMSEARCH_MENU();
           echo $erreur;
           echo footer();
           echo   '</body>
           </html>';
       }
   } else {
       print_LOGO_FORMSEARCH_MENU();
       formulaire_upload();
       echo footer();
       echo   '</body>
       </html>';
   }

?>
