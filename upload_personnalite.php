<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');


function formulaire_upload() {
    echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>
                <div class='container'>";

    if(isset($_SESSION["the_id"])) {

      echo "<form action='upload_personnalite.php' method='post' enctype='multipart/form-data'>
        <label class='label_formulaire' for='nom'>Nom : </label><input type='text' id='nom' name='nom' required /><br />
        <label class='label_formulaire' for='fonction'>Fonction : </label><input type='text' id='fonction' name='fonction' required /><br />
        <label class='label_formulaire' for='date_naissance'>Date de naissance : </label><input type='text' id='date_naissance' name='date_naissance' required /><br />
        <label class='label_formulaire' for='date_deces'>Date de décès : </label><input type='text' id='date_deces' name='date_deces' required /><br />
        <label class='label_formulaire' for='conjoint'>Conjoint : </label><input type='text' id='conjoint' name='conjoint' required /><br />
        <label class='label_formulaire' for='type_gisant'>Type gisant</label><input type='text' placeholder='marbre, pierre, etc' id='type_gisant' name='type_gisant' required /><br />
        <label class='label_formulaire' for='date_depot_gisant'>Date de dépôt du gisant</label><input placeholder='XIVe siècle' type='text' id='date_depot_gisant' name='date_depot_gisant' required /><br />
        <label class='label_formulaire' for='the_image'>Image : </label><input type='file' id='the_image' name='the_image' /> <br />
        <input type='submit' value='Envoyer' />
      </form>";
    }
    echo "</div></div></div><br /><br />";
}

if( isset($_POST["nom"]) && isset($_POST["fonction"]) && isset($_POST["date_naissance"]) && isset($_POST["date_deces"]) && isset($_POST["conjoint"]) && isset($_POST["type_gisant"]) && isset($_POST["date_depot_gisant"]) ) {
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
           $stmt = $pdo->prepare("INSERT INTO patrimoine_basilique_personnalite (nom, fonction, date_naissance, date_deces, conjoint, type_gisant, date_depot_gisant, imageURL)  VALUES (:nom, :fonction, :date_naissance, :date_deces, :conjoint, :type_gisant, :date_depot_gisant, :imageURL)");
           $stmt->bindParam(':nom', $_POST["nom"]);
           $stmt->bindParam(':fonction', $_POST["fonction"]);
           $stmt->bindParam(':date_naissance', $_POST["date_naissance"]);
           $stmt->bindParam(':date_deces', $_POST["date_deces"]);
           $stmt->bindParam(':conjoint', $_POST["conjoint"]);
           $stmt->bindParam(':type_gisant', $_POST["type_gisant"]);
           $stmt->bindParam(':date_depot_gisant', $_POST["date_depot_gisant"]);
           $stmt->bindParam(':imageURL', $imageURL);
           $stmt->execute();
           $id_personnalite = $pdo->lastInsertId();


           $stmt = $pdo->prepare("INSERT INTO historique_personnalite (id_personnalite, id_user)  VALUES (:id_personnalite, :id_user)");
           $stmt->bindParam(':id_personnalite', $id_personnalite);
           $stmt->bindParam(':id_user', $_SESSION["the_id"]);
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
