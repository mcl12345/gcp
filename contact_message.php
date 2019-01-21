<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>
            <h3>Les messages des utilisateurs</h3>
          </div>
        </div>";
echo "<div class='row'>
          <div class='col-lg-4'></div>
          <div class='col-lg-4'>";

$has_contact_message = false;
if($_COOKIE["the_role"] == "administrateur") {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM contact_nous");
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $has_contact_message = true;
    }
    if($has_contact_message) {
        echo "<form action='contact_message.php' method='post' />";
    }
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM contact_nous");
    $stmt->execute();
    while($row = $stmt->fetch()) {

        echo "Cochez ici pour supprimer : <input type='radio' name='delete_contact_message' value='".$row["id"]."' /><br />";
        echo "<strong>Nom : </strong>" . $row["nom"] . "<br />";
        echo "<strong>Email : </strong>" . $row["email"] . "<br />";
        echo "<strong>Numero de téléphone : </strong>" . $row["numero_telephone"] . "<br />";
        echo "<strong>Sujet : </strong>" . $row["sujet"] . "<br />";
        echo "<strong>Message : </strong>" . $row["message"] . "<br />";
        echo "<br /><br />";
    }
}

if($has_contact_message) {
    echo "<input type='submit' name='supprimer' value='Supprimer' />
    </form>";
}

if(isset($_POST["delete_contact_message"])) {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("DELETE FROM contact_nous WHERE id = ?");
    $stmt->execute(array($_POST["delete_contact_message"]));
}



echo '</div></div>';

echo '<br /><br />';
echo footer();
echo '</body>
</html>';

?>
