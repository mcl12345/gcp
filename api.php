<?php

header('Content-Type: application/json');
include('connection_bdd.php');

if(isset($_GET['id_personnalite']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM personnalite WHERE id = ?");
    if ($stmt->execute(array($_GET['id_personnalite']))) {
         while ($row = $stmt->fetch()) {
           if($row["valide"] == 1) {
              for($i = 0 ; $i<sizeof($row); $i++) {
                  unset($row[$i]);
              }
              echo json_encode($row, JSON_UNESCAPED_UNICODE);
            }
         }
    }
}

if(isset($_GET['personnalite']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM personnalite");
    if ($stmt->execute()) {
       while ($row = $stmt->fetch()) {
          for($i = 0 ; $i<sizeof($row); $i++) {
              unset($row[$i]);
          }
          if($row["valide"] == 1) {
              echo json_encode($row, JSON_UNESCAPED_UNICODE);
          }
       }
    }
}

if(isset($_GET['chapelle']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM chapelle");
    if ($stmt->execute()) {
       while ($row = $stmt->fetch()) {
          for($i = 0 ; $i<sizeof($row); $i++) {
              unset($row[$i]);
          }

          echo json_encode($row, JSON_UNESCAPED_UNICODE);
       }
    }
}

if(isset($_GET['id_chapelle']))  {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $stmt = $pdo->prepare("SELECT * FROM chapelle WHERE id= ?");
    if ($stmt->execute(array($_GET["id_chapelle"]))) {
       while ($row = $stmt->fetch()) {
          for($i = 0 ; $i<sizeof($row); $i++) {
              unset($row[$i]);
          }

          echo json_encode($row, JSON_UNESCAPED_UNICODE);
       }
    }
}

/**
* API
*/


?>
