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

      echo "<form action='upload_chapelle.php' method='post' enctype='multipart/form-data'>
        <label class='label_formulaire' for='nom'>Nom : </label><input type='text' id='nom' name='nom' required /><br />
        <label class='label_formulaire' for='titre1'>Titre1 : </label><input type='text' id='titre1' name='titre1' /><br />
        <label class='label_formulaire' for='description1'>Description 1 : </label><input placeholder='Description 1' id='description1' name='description1' /><br />
        <label class='label_formulaire' for='date1'>Date 1 : </label><input type='text' id='date1' name='date1' /><br />
        <label class='label_formulaire' for='composition1'>Composition 1 : </label><input type='text' id='composition1' name='composition1' /><br /><br />
        <label class='label_formulaire' for='titre2'>Titre 2 : </label><input type='text' id='titre2' name='titre2' /><br />
        <label class='label_formulaire' for='description2'>Description 2 : </label><input placeholder='Description 2' id='description2' name='description2' /><br />
        <label class='label_formulaire' for='date2'>Date 2 : </label><input type='text' id='date2' name='date2' /><br />
        <label class='label_formulaire' for='composition2'>Composition 2 : </label><input type='text' id='composition2' name='composition2' /><br /><br />
        <label class='label_formulaire' for='titre2'>Titre 3 : </label><input type='text' id='titre3' name='titre3' /><br />
        <label class='label_formulaire' for='description3'>Description 3 : </label><input placeholder='Description 3' id='description3' name='description3' /><br />
        <label class='label_formulaire' for='date3'>Date 3 : </label><input type='text' id='date3' name='date3' /><br />
        <label class='label_formulaire' for='composition3'>Composition 3 : </label><input type='text' id='composition3' name='composition3' /><br /><br />
        <label class='label_formulaire' for='titre4'>Titre 4 : </label><input type='text' id='titre4' name='titre4' /><br />
        <label class='label_formulaire' for='description4'>Description 4 : </label><input placeholder='Description 4' id='description4' name='description4' /><br />
        <label class='label_formulaire' for='date4'>Date 4 : </label><input type='text' id='date4' name='date4' /><br />
        <label class='label_formulaire' for='composition4'>Composition 4 : </label><input type='text' id='composition4' name='composition4' /><br /><br />
        <label class='label_formulaire' for='titre5'>Titre 5 : </label><input type='text' id='titre5' name='titre5' /><br />
        <label class='label_formulaire' for='description5'>Description 5 : </label><input placeholder='Description 5' id='description4' name='description5' /><br />
        <label class='label_formulaire' for='date5'>Date 5 : </label><input type='text' id='date5' name='date5' /><br />
        <label class='label_formulaire' for='composition5'>Composition 5 : </label><input type='text' id='composition5' name='composition5' /><br />
        <input type='file' name='the_image' /> <br />
        <input type='submit' value='Envoyer' />
      </form>";
    }
    echo "</div></div></div><br /><br />";
}

if( isset($_POST["nom"]) && isset($_POST["titre1"]) && isset($_POST["description1"]) && isset($_POST["date1"]) && isset($_POST["composition1"]) && isset($_FILES['the_image']['name'])) {
  $dossier = "upload_images/";
  $fichier = basename($_FILES['the_image']['name']);
  $taille_maxi = 100000000; // 100 Mo
  $taille = filesize($_FILES['the_image']['tmp_name']); // Le fichier temporaire

  $extensions = array( '.jpeg', '.jpg', '.png');

  $extension = strrchr($_FILES['the_image']['name'], '.');

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
         $stmt = $pdo->prepare("INSERT INTO chapelle (nom, titre1, description1, date1, composition1, titre2, description2, date2, composition2, titre3,
           description3, date3, composition3, titre4, description4, date4, composition4, titre5, description5, date5, composition5, imageURL)
           VALUES (:nom, :titre1, :description1, :date1, :composition1, :titre2, :description2, :date2, :composition2, :titre3,
             :description3, :date3, :composition3, :titre4, :description4, :date4, :composition4, :titre5, :description5, :date5, :composition5, :imageURL)");
         $stmt->bindParam(':nom', $_POST["nom"]);
         $stmt->bindParam(':titre1', $_POST["titre1"]);
         $stmt->bindParam(':description1', $_POST["description1"]);
         $stmt->bindParam(':date1', $_POST["date1"]);
         $stmt->bindParam(':composition1', $_POST["composition1"]);
         $stmt->bindParam(':titre2', $_POST["titre2"]);
         $stmt->bindParam(':description2', $_POST["description2"]);
         $stmt->bindParam(':date2', $_POST["date2"]);
         $stmt->bindParam(':composition2', $_POST["composition2"]);
         $stmt->bindParam(':titre3', $_POST["titre3"]);
         $stmt->bindParam(':description3', $_POST["description3"]);
         $stmt->bindParam(':date3', $_POST["date3"]);
         $stmt->bindParam(':composition3', $_POST["composition3"]);
         $stmt->bindParam(':titre4', $_POST["titre4"]);
         $stmt->bindParam(':description4', $_POST["description4"]);
         $stmt->bindParam(':date4', $_POST["date4"]);
         $stmt->bindParam(':composition4', $_POST["composition4"]);
         $stmt->bindParam(':titre5', $_POST["titre5"]);
         $stmt->bindParam(':description5', $_POST["description5"]);
         $stmt->bindParam(':date5', $_POST["date5"]);
         $stmt->bindParam(':composition5', $_POST["composition5"]);
         $stmt->bindParam(':imageURL', $imageURL);
         $stmt->execute();
         $id_chapelle = $pdo->lastInsertId();

         $stmt = $pdo->prepare("INSERT INTO historique_chapelle (id_chapelle, id_user)  VALUES (:id_chapelle, :id_user)");
         $stmt->bindParam(':id_chapelle', $id_chapelle);
         $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
         $stmt->execute();

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
       echo 'Echec de l\'upload !';
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
