<?php

include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$stmt = $pdo->prepare("SELECT * FROM chapelle");
if ($stmt->execute()) {
  echo "<div class='row'>
        <div class='col-lg-2'></div>
        <div class='col-lg-4'>
            <div class='container'>";
   while ($row = $stmt->fetch()) {

      if($row["valide"] == 1) {
        echo "<strong>nom : </strong>" . $row["nom"] . "<br />";
        echo "<strong>titre1 : </strong>" . $row["titre1"] . "<br />";
        echo "<strong>description1 : </strong>" . $row["description1"] . "<br />";
        echo "<strong>date1 : </strong>" . $row["date1"] . "<br />";
        echo "<strong>composition1 : </strong>" . $row["composition1"] . "<br /><br />";
        echo "<strong>titre2 : </strong>" . $row["titre2"] . "<br />";
        echo "<strong>description2 : </strong>" . $row["description2"] . "<br />";
        echo "<strong>date2 : </strong>" . $row["date2"] . "<br />";
        echo "<strong>composition2 : </strong>" . $row["composition2"] . "<br />";
        echo "<strong>titre3 : </strong>" . $row["titre3"] . "<br /><br />";
        echo "<strong>description3 : </strong>" . $row["description3"] . "<br />";
        echo "<strong>date3 : </strong>" . $row["date3"] . "<br />";
        echo "<strong>composition3 : </strong>" . $row["composition3"] . "<br /><br />";
        if($row["titre4"] != "") {
            echo "<strong>titre4 : </strong>" . $row["titre4"] . "<br />";
            echo "<strong>description4 : </strong>" . $row["description4"] . "<br />";
            echo "<strong>date4 : </strong>" . $row["date4"] . "<br />";
            echo "<strong>composition4 : </strong>" . $row["composition4"] . "<br /><br />";
        }
        if($row["titre5"] != "") {
            echo "<strong>titre5 : </strong>" . $row["titre5"] . "<br />";
            echo "<strong>description5 : </strong>" . $row["description5"] . "<br />";
            echo "<strong>date5 : </strong>" . $row["date5"] . "<br />";
            echo "<strong>composition5 : </strong>" . $row["composition5"] . "<br />";
        }
        echo "<strong>image : </strong><a target='_blank' href='".$row["imageURL"]."'><img src='" . $row["imageURL"] . "' width='250px' height='250px' /></a><br />";
        echo "<br /><br /><br />";
      }
   }
   echo "</div></div></div>";
}

echo footer();

echo '</body>
</html>';

?>
