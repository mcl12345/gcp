<?php


include('logo_search_menu.php');


function formulaire_upload() {
    echo "<form method='post' action='upload_texte.php'>
              <label for='titre'>Titre : </label><input id='titre' name='titre' type='text' required /><br />
              <textarea rows='4' cols='50' placeholder='Taper votre texte ici' name ='texte_upload'></textarea><br /><br />
              <input type='submit' name='envoyer' value='Envoyer' />
    </form>";
}

if(isset($_POST['titre']) && isset($_POST['texte_upload'])) {
  echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
    echo 'Upload du texte effectué avec succès !';
    echo '</div></body>
    </html>';
}

echo "<div class='row'>
        <div class='col-lg-4'></div>
        <div class='col-lg-4'>";
formulaire_upload();
echo "</div></div></div></body>
</html>";

?>
