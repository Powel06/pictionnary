<?php
/**
 * Created by PhpStorm.
 * User: pa500802
 * Date: 28/11/2017
 * Time: 15:42
 */

include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>Pictionnary - Inscription</title>
    <link rel="stylesheet" media="screen" href="css/styles.css" >
</head>
<body>
<div class="col-md-5">
                    <form role="form" action="req_inscription.php" method="post">
                        <!-- c'est quoi les attributs action et method ?
    L'attribut action sert a envoyer vers le fichier req_inscription.php les valeurs du formulaire que l'utilisateur a saisi.
    L'attribut method sert a definir la maniere dont le formulaire sera transmis : soit post ou get, ici c'est post.-->
    <!-- qu'y a-t-il d'autre comme possiblité que post pour l'attribut method ?
    Il y a la possibilité d'utiliser method="get" mais la methode post est preferable car avec la methode get les informations transmises dans le questionnaire seront presentes dans l'url.-->
                        <fieldset>                          
                            <p class="text-uppercase pull-center"> S'enregistrer</p> 
                            <div class="form-group">
                                <label for="email">E-mail :</label>
                                <input type="email" name="email" id="email" class="form-control input-lg" autofocus required/>
                                <!-- ajouter à input l'attribut qui lui donne le focus automatiquement -->
            <!-- ajouter à input l'attribut qui dit que c'est un champs obligatoire -->
            <!-- quelle est la différence entre les attributs name et id ?
            La difference est que l'attribut name va etre utilisé lors de la recuperation de données en php et l'id lui est utilisé pour la partie html/css.-->
            <!-- c'est lequel qui doit être égal à l'attribut for du label ?
            C'est l'id qui doit etre egal a l'attribut for.-->

                            </div>

                            <div class="form-group">
                                <label for="mdp1">Mot de passe :</label>
                                <input type="password" name="password" id="mdp1" class="form-control input-lg" pattern="[A-Za-z0-9]{6,8}" required placeholder="Entrer votre mot de passe" onkeyup="validateMdp2()" title = "Le mot de passe doit contenir de 6 à 8 caractères alphanumériques.">
                                <!-- ajouter à input l'attribut qui dit que c'est un champs obligatoire -->
            <!-- ajouter à input l'attribut qui donne une indication grisée (placeholder) -->
            <!-- spécifiez l'expression régulière: le mot de passe doit être composé de 6 à 8 caractères alphanumériques -->
            <!-- quels sont les deux scénarios où l'attribut title sera affiché ?
            le title s'affiche si on passe la souris sur le champ et si on remplit pas les conditions en fonction du pattern.-->
            <!-- encore une fois, quelle est la différence entre name et id pour un input ?
            L'id est lié au for dans le label et doit avec le meme nom alors que le name va servir lors de la recuperation de données en php.-->
                            </div>
                            <div class="form-group">
                                <label for="mdp2">Confirmez mot de passe :</label>
                                <input type="password" id="mdp2" class="form-control input-lg" required placeholder="Confirmer votre mot de passe" onkeyup="validateMdp2()">
                                            <!-- ajouter à input l'attribut qui dit que c'est un champs obligatoire -->
            <!-- ajouter à input l'attribut qui donne une indication grisée (placeholder) -->
            <!-- pourquoi est-ce qu'on a pas mis un attribut name ici ?
            Car on ne recupere pas les données pour cet input mais pour l'input du dessus "Mot de passe :".-->
            <!-- quel scénario justifie qu'on ait ajouté l'écouter validateMdp2() à l'évènement onkeyup de l'input mdp1 ?
            si l'utilisateur remplit un mdp1 et qu'il met le meme mot de passe pour mdp2 puis qu'il rechange le mdp1 et qu'il valide, sans l'ecouteur cela va valider.-->
                                <script>
                                validateMdp2 = function(e) {
                                    var mdp1 = document.getElementById('mdp1');
                                    var mdp2 = document.getElementById('mdp2');
                                    if (mdp1.value == mdp2.value) {
                                        // ici on supprime le message d'erreur personnalisé, et du coup mdp2 devient valide.
                                        document.getElementById('mdp2').setCustomValidity('');
                                    } else {
                                        // ici on ajoute un message d'erreur personnalisé, et du coup mdp2 devient invalide.
                                        document.getElementById('mdp2').setCustomValidity('Les mots de passes doivent être égaux.');
                                    }
                                }
                                </script>
                            </div>
                                <div class="form-group">
                                <label for="birthdate">Date de naissance:</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control input-lg" placeholder="JJ/MM/AAAA" required onchange="computeAge()"/>
                                <script>
                                    computeAge = function(e) {
                                        try{
                                            var dateAuj = Date.now();
                                            var dateAnniv = Date.parse(document.getElementById("birthdate").valueAsDate);
                                            age = dateAuj - dateAnniv;
                                            age = age /31536000000;
                                            document.getElementById("age").value = Math.floor(age);
                                        } catch(e) {
                                            // supprimez ici la valeur de l'élément age
                                            document.getElementById("age").value = "";
                                        }
                                    }
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="number" name="age" class="form-control input-lg" id="age" disabled/>
                                            <!-- à quoi sert l'attribut disabled ?
            disabled est utile si on veut bloquer la case pour ne rien pouvoir entrer dedans.-->
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input class="form-control input-lg" type="text" name="nom" id="nom"/>
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom :</label>
                                <input type="text" name="prenom" id="prenom" class="form-control input-lg" required placeholder="Entrez votre prénom"/>
                                            <!-- ajouter à input l'attribut qui dit que c'est un champs obligatoire -->
            <!-- ajouter à input l'attribut qui donne une indication grisée (placeholder) -->
                            </div>
                            <div class="form-group">
                                <label for="tel">Telephone :</label>
                                <input type="tel" class="form-control input-lg" name="tel" id="tel"/>
                            </div>
                            <div class="form-group">
                                <label for="website">Site web :</label>
                                <input type="url" class="form-control input-lg" name="website" id="website"/>
                            </div>
                            <div class="form-group">
                                <label for="sexe">Sexe :</label>
                                <input type="radio" name="sexe" id="sexe" value="homme"/>Homme
                                <input type="radio" name="sexe" id="sexe" value="femme"/>Femme
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville :</label>
                                <input type="text" class="form-control input-lg" name="ville" id="ville"/>
                            </div>
                            <div class="form-group">
                                <label for="taille">Taille :</label>
                                <input type="range" name="taille" id="taille" class="form-control input-lg" min="0" max="2.50" step="0.01"/>
                            </div>
                            <div class="form-group">
                                <label for="couleur">Couleur préférée :</label>
                                <input type="color" class="form-control input-lg" name="couleur" id="couleur" value="#000000"/>
                            </div>
                            <div class="form-group">
                                <label for="profilepicfile">Photo de profil:</label>
                                <input type="file" id="profilepicfile" onchange="loadProfilePic(this)"/>
                                                                 <!-- l'input profilepic va contenir le chemin vers l'image sur l'ordinateur du client -->
            <!-- on ne veut pas envoyer cette info avec le formulaire, donc il n'y a pas d'attribut name -->
                                <span class="form_hint">Choisissez une image.</span>
                                <input type="hidden" name="profilepic" id="profilepic"/>
            <!-- l'input profilepic va contenir l'image redimensionnée sous forme d'une data url -->
            <!-- c'est cet input qui sera envoyé avec le formulaire, sous le nom profilepic -->
                                <canvas id="preview" width="0" height="0"></canvas>
                                <!-- le canvas (nouveauté html5), c/'est ici qu'on affichera une visualisation de l'image. -->
            <!-- on pourrait afficher l'image dans un élément img, mais le canvas va nous permettre également
            de la redimensionner, et de l'enregistrer sous forme d'une data url-->
            <script>
                loadProfilePic = function (e) {
                    // on récupère le canvas où on affichera l'image
                    var canvas = document.getElementById("preview");
                    var ctx = canvas.getContext("2d");
                    // on réinitialise le canvas: on l'efface, et déclare sa largeur et hauteur à 0
                    ctx.setFillColor = "white";
                    ctx.fillRect(0,0,canvas.width,canvas.height);
                    canvas.width=0;
                    canvas.height=0;
                    // on récupérer le fichier: le premier (et seul dans ce cas là) de la liste
                    var file = document.getElementById("profilepicfile").files[0];
                    // l'élément img va servir à stocker l'image temporairement
                    var img = document.createElement("img");
                    // l'objet de type FileReader nous permet de lire les données du fichier.
                    var reader = new FileReader();
                    // on prépare la fonction callback qui sera appelée lorsque l'image sera chargée
                    reader.onload = function(e) {
                        //on vérifie qu'on a bien téléchargé une image, grâce au mime type
                        if (!file.type.match(/image.*/)) {
                            // le fichier choisi n'est pas une image: le champs profilepicfile est invalide, et on supprime sa valeur
                            document.getElementById("profilepicfile").setCustomValidity("Il faut télécharger une image.");
                            document.getElementById("profilepicfile").value = "";
                        }
                        else {
                            // le callback sera appelé par la méthode getAsDataURL, donc le paramètre de callback e est une url qui contient
                            // les données de l'image. On modifie donc la source de l'image pour qu'elle soit égale à cette url
                            // on aurait fait différemment si on appelait une autre méthode que getAsDataURL.
                            img.src = e.target.result;
                            // le champs profilepicfile est valide
                            document.getElementById("profilepicfile").setCustomValidity("");
                            var MAX_WIDTH = 96;

                            // A FAIRE: si on garde les deux lignes suivantes, on rétrécit l'image mais elle sera déformée
                            // Vous devez supprimer ces lignes, et modifier width et height pour:
                            //    - garder les proportions,
                            //    - et que le maximum de width et height soit égal à 96
                            var width = MAX_WIDTH;
                            var tmp = img.width/MAX_WIDTH;
                            var height = img.height/tmp;

                            canvas.width = width;
                            canvas.height = height;
                            // on dessine l'image dans le canvas à la position 0,0 (en haut à gauche)
                            // et avec une largeur de width et une hauteur de height
                            ctx.drawImage(img, 0, 0, width, height);
                            // on exporte le contenu du canvas (l'image redimensionnée) sous la forme d'une data url
                            var dataurl = canvas.toDataURL("image/png");
                            // on donne finalement cette dataurl comme valeur au champs profilepic
                            document.getElementById("profilepic").value = dataurl;
                        };
                    }
                    // on charge l'image pour de vrai, lorsque ce sera terminé le callback loadProfilePic sera appelé.
                    reader.readAsDataURL(file);
                }
            </script>
                            </div>
                            <div>
                                    <input type="submit" class="btn btn-lg btn-primary">
                            </div>
                        </fieldset>
                    </form>
                </div>
</body>
</html>

