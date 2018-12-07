<?php

ini_set("allow_url_fopen", 1);

$url = "http://213.32.90.43/basilique-saint-denis/api.php?image=true";
$json_file = file_get_contents($url);
$obj = json_decode($json_file);
for ($i=0; $i < sizeof($obj->images); $i++) {
  echo $obj->images[$i]->id . "<br />";
  echo $obj->images[$i]->imageURL . "<br />";
}

?>
