<?php


include('logo_search_menu.php');


function formulaire_upload() {
    echo "<form method='post' action='upload.php' enctype='multipart/form-data'>
              <label for='titre'>Titre : </label><input id='titre' name='titre' type='text' required /><br />
              <input type='file' name='the_image' /> <br />
              <input type='submit' name='envoyer' value='Envoyer' />
    </form>";
}

if(isset($_POST['titre']) && isset($_FILES['the_image']['name'])) {
  $dossier = "upload_images/";
  $fichier = basename($_FILES['the_image']['name']);
  $taille_maxi = 100000000; // 100 Mo
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
            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                 <div class='col-lg-4'></div>
                 <div class='col-lg-4'>";
            echo 'Upload de l\'image effectué avec succès !';
            echo '</div></div></div></body>
            </html>';
       }
       else //Sinon (la fonction renvoie FALSE).
       {
            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                 <div class='col-lg-4'></div>
                 <div class='col-lg-4'>";
            echo 'Echec de l\'upload !';
            echo '</div></div></div></body>
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
       echo '</div></div></div></body>
       </html>';
  }
}

print_LOGO_FORMSEARCH_MENU();
echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>";
formulaire_upload();
echo '</div></div></div></body>
</html>';

 ?>
