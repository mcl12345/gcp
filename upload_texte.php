<?php


include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');


function formulaire_upload() {
    echo "<form method='post' action='upload_texte.php'>
              <label for='titre'>Titre : </label><input id='titre' name='titre' type='text' required /><br />
              <input placeholder='Taper votre texte ici' name ='texte_upload' required /><br /><br />
              <input type='submit' name='envoyer' value='Envoyer' />
    </form>";
}

if(isset($_POST['titre']) && isset($_POST['texte_upload'])) {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

  // set the PDO error mode to exception
  $stmt = $pdo->prepare("INSERT INTO texte (titre, texte) VALUES (:titre, :texte)");
  $stmt->bindParam(':titre', $_POST["titre"]);
  $stmt->bindParam(':texte', $_POST["texte_upload"]);
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
