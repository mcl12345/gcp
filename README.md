# gcp : Gestion et Conduite de Projets

# Plateforme sur la basilique de Saint-Denis :

Il est possible de s'inscrire sur la plateforme http://213.32.90.43/basilique-saint-denis/login.php ou http://213.32.90.43/basilique-saint-denis/register.php<br />
On peut ajouter des rois depuis l'onglet "Personnalités" > "Ajouter un roi"<br />
On peut ajouter des réseaux sociaux aux rois depuis l'onglet "Personnalités" > "Ajouter un roi depuis les réseaux sociaux".<br />
On peut ajouter des représentations aux rois depuis l'onglet "Personnalités" > "Ajouter à un roi des représentations".<br />
On peut ajouter des commentaires aux rois depuis l'onglet "Personnalités" > "Afficher tous les rois" > <br />Cocher le bouton radio > Cliquer sur Explorer en bas de page > Lire ou Remplir le champ commentaire et cliquer sur 'Envoyer'.<br /><br />

Après il est possible d'avoir accès à l'API via http://213.32.90.43/basilique-saint-denis/api.php<br />
Pour les commentaires : http://213.32.90.43/basilique-saint-denis/api.php?commentaire=true<br />
Pour l'associationRR : http://213.32.90.43/basilique-saint-denis/api.php?associationrr=true<br />
Pour la représentation : http://213.32.90.43/basilique-saint-denis/api.php?representation=true<br />
Pour les rois : http://213.32.90.43/basilique-saint-denis/api.php?roi=true<br /><br />

Comment récupérer des images ( vidéos, textes, fichiers audio, des rois, des chapelles, des personnalités royales ) <br />en PHP à partir du code JSON suivant avec l'URL suivante : "http://213.32.90.43/basilique-saint-denis/api.php?image=true"
<br />
JSON structure :

    images
        0
           id    2
           titre    ""
           imageURL    "http://213.32.90.43/basilique-saint-denis/upload_images/IMG-20181010-162121.jpg"
           description    "la crypte2"
           valide    1
        1
      etc...

------------------
En PHP :
     
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
    ?>

---------------
Pour Android :

    val connMgr = getSystemService(Context.CONNECTIVITY_SERVICE) as ConnectivityManager
    when (connMgr.activeNetworkInfo?.type) {
       ConnectivityManager.TYPE_WIFI, ConnectivityManager.TYPE_MOBILE -> {                    
           DownloadTask().execute(URL("http://213.32.90.43/basilique-saint-denis/api.php?image=true"))
       }
       null -> { toast("Pas de réseau ") }
    }
    
    
    // Code venant de ce site :
    // FROM http://tutorielandroid.francoiscolin.fr/recupjson.php
    inner class DownloadTask : AsyncTask<URL, Void, JSONArray >() {
        override fun doInBackground(vararg params: URL): JSONArray?  {
            try {
                val conn = params[0].openConnection() as HttpURLConnection
                conn.connect()
                if(conn.responseCode != HttpURLConnection.HTTP_OK) {
                    return null
                } else {
                    val inputStream = conn.getInputStream()

                    /*
                    * InputStreamOperations est une classe complémentaire:
                    * Elle contient une méthode InputStreamToString.
                    */
                    val result = InputStreamOperations.InputStreamToString(inputStream)
                    // On récupère le JSON complet
                    val jsonObject = JSONObject(result)
                    // On récupère l'élément qui nous concernent
                    return JSONArray(jsonObject.getString("produits"))
                }
            } catch (e : FileNotFoundException) {
                return null
            } catch (e : UnknownHostException) {
                return null
            } catch (e : ConnectException) {
                return null
            } catch (e : IOException) {
                return null
            } catch (e : org.json.JSONException) {
                return null
            }
        }

        override fun onPostExecute(result: JSONArray?) {
            super.onPostExecute(result)
            // Pour tous les objets on récupère les infos
            if (result == null ) {
                Log.e("AFFICHER", "null")
            } else {
                Log.e("AFFICHER", result.length().toString())

                for(i in 0..(result.length() - 1)) {
                    // On récupère un objet JSON du tableau
                    var obj = JSONObject(result.getString(i))
                    Log.e("AFFICHER", obj.getString("titre"))
                    var titre = obj.getString("titre")
                    var imageURL = obj.getString("imageURL")
                    var description = obj.getString("description")
                    var validite = obj.getInt("valide")                    

                    saveToDB(titre, imageURL, description, validite)
                }
            }
        }
    }
