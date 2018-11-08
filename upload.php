<?php

function formulaire_upload() {
    echo "<form method='post' action='upload.php' enctype='multipart/form-data'>
              <label for='titre'>Titre : </label><input id='titre' name='titre' type='text' required /><br />
              <input type='file' name='the_mp3' /> <br />
              <input type='submit' name='envoyer' value='Envoyer' />
    </form>";
}

if(isset($_POST['titre']) && isset($_FILES['the_mp3']['name'])) {
  $dossier = "upload/";
  $fichier = basename($_FILES['the_mp3']['name']);
  $taille_maxi = 100000000; // 100 Mo
  $taille = filesize($_FILES['the_mp3']['tmp_name']); // Le fichier temporaire
  $extensions = array('.mp3', '.wav', '.jpg', '.jpeg');
  $extension = strrchr($_FILES['the_mp3']['name'], '.');
  //Début des vérifications de sécurité...
  if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
  {
       $erreur = 'Vous devez uploader un fichier de type .mp3 ou .wav';
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
       if(move_uploaded_file($_FILES['the_mp3']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
       {
            echo 'Upload effectué avec succès !';
       }
       else //Sinon (la fonction renvoie FALSE).
       {
            echo 'Echec de l\'upload !';
       }
  }
  else
  {
       echo $erreur;
  }
}

formulaire_upload();

 ?>
