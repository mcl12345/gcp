<?php

// http://php.net/manual/fr/filesystem.configuration.php#ini.allow-url-fopen
ini_set("allow_url_fopen", 1);

$url = "http://213.32.90.43/basilique-saint-denis/api.php?image=true";
$json_file = file_get_contents($url);
$obj = json_decode($json_file);
for ($i=0; $i < sizeof($obj->images); $i++) {
    echo $i . " : ";
    echo "Titre : " . $obj->images[$i]->titre . "<br />";
    echo "<img width='200' height='200' src='" . $obj->images[$i]->imageURL . "'/><br /><br /><br />";
}

/*
JSON :

images
    0
      id	2
      titre	""
      imageURL	"http://213.32.90.43/basilique-saint-denis/upload_images/IMG-20181010-162121.jpg"
      description	"la crypte2"
      valide	1
    1
      etc...
*/

?>
