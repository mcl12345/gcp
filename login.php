<?php

include("connection_bdd.php");
include('logo_search_menu.php');
include('footer.php');


function formulaire_login_HTML() {
	echo "<br><br><br>";
    echo "<form method='post' action='login.php'>
                  <label class='label_formulaire' for='username'>Nom d'utilisateur : </label><input id='username' name='username' type='text' required /><br />
                  <label class='label_formulaire' for='plain_password'>Mot de passe : </label><input id='plain_password' name='plain_password' id='plain_password' type='password' required /><br />
                  <input type='submit' value='Connexion' />
              </form>";
}



// Ici on vérifie si l'utilisateur s'est correctement connecté
$bool_wrong_user = true;
if( !empty($_POST["username"]) &&
    !empty($_POST["plain_password"])) {

        // On sauvegarde dans des variables :
        $my_username = $_POST['username'];
        $my_password_encoded = md5($_POST['plain_password']);
        $my_email = "";
        $my_role = "";

        // Verification du bon password selon l'username donné
        $bool_verification_password = false;
        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $stmt = $pdo->prepare("SELECT * FROM user where username = ?");
            if ($stmt->execute(array($my_username))) {
                while ($row = $stmt->fetch()) {
                    $bool_wrong_user = false;
                    if($row['password_encoded'] == $my_password_encoded) {
                        $bool_verification_password = true;
                        $my_id = $row['id'];
                        $my_email = $row['email'];
                        $my_role = $row['role'];
                    }
                }
            }
        } catch(PDOException $e) {
            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                  <div class='col-lg-4'></div>
                  <div class='col-lg-4'>";
            echo $sql . "</ br>a" . $e->getMessage();
            echo '</div></div></div>';
            echo footer();
            echo '</body>
          </html>';
        }

      if( $bool_verification_password) {
          // Insertion COOKIES
          setcookie("the_id", $my_id);
          setcookie("the_username", $my_username);
          setcookie("the_email", $my_email);
          setcookie("the_password_encoded", $my_password_encoded);
          setcookie("the_role", $my_role);

          header('Location: login.php');
          /*print_LOGO_FORMSEARCH_MENU();
          echo "<div class='row'>
                    <div class='col-lg-4'></div>
                    <div class='col-lg-4'>";
          echo "Vous êtes bien authentifié en tant que " . $my_username . " !";
          echo '</div></div></div><br /><br />';
          echo footer();
          echo '</body>
          </html>';*/
      } else if (!$bool_wrong_user) {
        print_LOGO_FORMSEARCH_MENU();
        echo "<div class='row'>
                <div class='col-lg-4'></div>
                <div class='col-lg-4'>";
            echo "Mauvais password<br />";
            formulaire_login_HTML();
            echo '</div></div></div><br /><br />';
            echo footer();
            echo '</body>
            </html>';
      } else {
        print_LOGO_FORMSEARCH_MENU();
        echo "<div class='row'>
                <div class='col-lg-4'></div>
                <div class='col-lg-4'>";
            echo "Utilisateur inconnu<br />";
            formulaire_login_HTML();
            echo '</div></div></div><br /><br />';
            echo footer();
            echo '</body>
            </html>';
      }
}
else if (isset($_COOKIE['the_username'])) {
    print_LOGO_FORMSEARCH_MENU();
	echo "<br><br><br>";
    echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>";
	echo "<h3>";
    echo "Bienvenue " . $_COOKIE["the_username"] . " !";
	echo "</h3>";
    echo '</div></div></div><br /><br />';
    echo footer();
    echo '</body>
    </html>';
} else {
    print_LOGO_FORMSEARCH_MENU();
    echo "<div class='row'>
            <div class='col-lg-4'></div>
            <div class='col-lg-4'>";
    formulaire_login_HTML();
    echo '</div></div></div><br /><br/>';

    echo footer();

    echo '</body>
    </html>';
}

?>
