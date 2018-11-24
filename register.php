<?php

include("connection_bdd.php");
include('logo_search_menu.php');
include('footer.php');

function formulaire_register_HTML() {
    echo "<br />
                <form method='post' action='register.php'>
                      <label class='label_formulaire' for='username'>Username : </label><input id='username' name='username' type='text' required /><br />
                      <label class='label_formulaire' for='email'>Email : </label><input id='email' name='email' placeholder='joe@example.com' type='text' required /><br />
                      <label class='label_formulaire' for='plain_password'>Password : </label><input id='plain_password' name='plain_password' id='plain_password' type='password' required /><br />
                      <label class='label_formulaire' for='confirm_plain_password'>Confirm the password : </label><input id='confirm_plain_password' name='confirm_plain_password' type='password' required /><br />
                      <label class='label_formulaire' for='role'>Rôle : </label><select name ='role'>
                              <option value='administrateur'>Administrateur</option>
                              <option value='utilisateur'>Utilisateur</option>
                      </select><br /><br />
                      <label class='label_formulaire' for='fonction'>Fonction : </label><select name ='fonction'>
                              <option value='amateur'>Amateur</option>
                              <option value='expert'>Expert</option>
                      </select><br /><br />
                      <label class='label_formulaire' for='token_admin'>Token admin : </label><input id='token_admin' name ='token_admin' type='text' placeholder='1234' /><br /><br />
                      <input type='submit' value='Envoyer' />
                </form><br /><br />";

}


// Ici on vérifie si l'utilisateur s'est correctement enregistré
if( !empty($_POST["username"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["plain_password"]) &&
    !empty($_POST["confirm_plain_password"]) &&
    !empty($_POST["role"]) &&
    !empty($_POST["fonction"]) &&
    $_POST["plain_password"] == $_POST["confirm_plain_password"]) {

      //  On sauvegarde les variables
      $my_username          = $_POST['username'];
      $my_email             = $_POST['email'];
      $my_password_encoded  = md5($_POST['plain_password']);
      $my_role              = $_POST['role'];
      $my_fonction          = $_POST['fonction'];
      $token_admin          = $_POST['token_admin'];

      if (($my_role == "administrateur" && $token_admin == 1990) || $my_role == "utilisateur") {
          // Vérification :
          $bool_verification_email = true;
          $bool_verification_username = true;
          try {
              $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
              //$pdo = new PDO("mysql:host='localhost';dbname='basilique'", 'root', '');
              $stmt = $pdo->query('SELECT * FROM user');
              while ($row = $stmt->fetch()) {
                  if($row['email'] == $my_email) {
                      $bool_verification_email = false;
                  }
                  if($row['username'] == $my_username) {
                      $bool_verification_username = false;
                  }
              }
          } catch(PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
          }

          // Ce compte n'existe pas , on le créée
          if($bool_verification_email == true && $bool_verification_username == true) {

              // Insertion MySQL
              try {
                 $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                 // set the PDO error mode to exception
                 $stmt = $pdo->prepare("INSERT INTO user (username, email, password_encoded, role, fonction)  VALUES (:username, :email, :password_encoded, :role, :fonction)");
                 $stmt->bindParam(':username', $my_username);
                 $stmt->bindParam(':email', $my_email);
                 $stmt->bindParam(':password_encoded', $my_password_encoded);
                 $stmt->bindParam(':role', $my_role);
                 $stmt->bindParam(':fonction', $my_fonction);
                 $stmt->execute();

                 print_LOGO_FORMSEARCH_MENU();
                echo "<div class='row'>
                           <div class='col-lg-4'></div>
                           <div class='col-lg-4'>";
                 echo "Enregistrement effectué avec succès !<br />";
                 echo '</div></div></div>';
                 echo footer();
                 echo '</body>
                 </html>';
              }
              catch(PDOException $e) {
                print_LOGO_FORMSEARCH_MENU();
                echo "<div class='row'>
                           <div class='col-lg-4'></div>
                           <div class='col-lg-4'>";
                 echo "Enregistrement effectué avec succès !<br />";
                  echo $sql . "<br>" . $e->getMessage();
                  echo '</div></div></div>';
                  echo footer();
                  echo '</body>
                  </html>';
              }
          }
          if ($bool_verification_email == false ) {
            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                       <div class='col-lg-4'></div>
                       <div class='col-lg-4'>";
              echo "Ce compte avec cet email existe déjà.<br />";
              echo '</div></div></div>';
              echo footer();
              echo '</body>
              </html>';
          }
          if ($bool_verification_username == false ) {
            print_LOGO_FORMSEARCH_MENU();
            echo "<div class='row'>
                       <div class='col-lg-4'></div>
                       <div class='col-lg-4'>";
              echo "Ce compte avec cet username existe déjà.<br />";
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
          echo "Le token est erroné !<br />";
          formulaire_register_HTML();
          echo '</div></div></div>';
          echo footer();
          echo '</body>
          </html>';
      }

      $pdo = null;
}
// On affiche le formulaire
else {
  print_LOGO_FORMSEARCH_MENU();
  echo "<div class='row'>
             <div class='col-lg-4'></div>
             <div class='col-lg-4'>";
    formulaire_register_HTML();
    echo '</div></div></div>';
    echo footer();
    echo '</body>
    </html>';
}

 ?>
