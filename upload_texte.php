<?php


include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');


function formulaire_upload() {
    echo "<form method='post' action='upload_texte.php'>
              <label for='titre'>Titre : </label><input id='titre' name='titre' type='text' required /><br />
              <label for='titre'>Texte : </label><input type='texte' placeholder='Taper votre texte ici' name ='texte_upload' required /><br /><br />
              <label for='titre'>Mots-clé : </label><input type='texte' placeholder='Taper vos mot_cles séparé par un espace ( max 3 )' style='width: 400px;' name ='mot_cle' required /><br /><br />
              <input type='submit' name='envoyer' value='Envoyer' />
    </form>";
}

if(isset($_POST['titre']) && isset($_POST['texte_upload'])) {

  $mots_cle = explode(" ", $_POST["mot_cle"]);

  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
  // set the PDO error mode to exception ???
  $stmt = $pdo->prepare("INSERT INTO texte (titre, texte, mot_cle1, mot_cle2, mot_cle3) VALUES (:titre, :texte, :mot_cle1, :mot_cle2, :mot_cle3)");
  $stmt->bindParam(':titre', $_POST["titre"]);
  $stmt->bindParam(':texte', $_POST["texte_upload"]);
  $stmt->bindParam(':mot_cle1', $mots_cle[0]);
  $stmt->bindParam(':mot_cle2', $mots_cle[1]);
  $stmt->bindParam(':mot_cle3', $mots_cle[2]);
  $stmt->execute();
  $id_texte = $pdo->lastInsertId();

  $stmt = $pdo->prepare("INSERT INTO historique_texte (id_texte, id_user)  VALUES (:id_texte, :id_user)");
  $stmt->bindParam(':id_texte', $id_texte);
  $stmt->bindParam(':id_user', $_COOKIE["the_id"]);
  $stmt->execute();

  print_LOGO_FORMSEARCH_MENU();
  echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";
    echo 'Upload du texte effectué avec succès !';
    echo '</div></div></div>';
    echo '<br /><br />';
    echo footer();
    echo '</body>
    </html>';
} else {

    print_LOGO_FORMSEARCH_MENU();
    echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>";
    formulaire_upload();
    echo '</div></div></div>';
    echo '<br /><br />';
    echo footer();
    echo '</body>
    </html>';
}

?>
