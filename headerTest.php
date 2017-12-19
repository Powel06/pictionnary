<?php
/**
 * Created by PhpStorm.
 * User: ty500362
 * Date: 05/12/2017
 * Time: 16:45
 */

error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>Pictionnary</title>
</head>
<!-- <header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js" ></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>

    <link rel="stylesheet" media="screen" href="css/styles.css" > -->
<script type="text/javascript">
    /*$(function() {

        $('#login-form-link').click(function(e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
        });
        $('#register-form-link').click(function(e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
        });

    });*/
    validateMdp2 = function(e) {
        var mdp1 = document.getElementById('mdp1');
        var mdp2 = document.getElementById('mdp2');
        if (mdp1.value == mdp2.value ) {
            // ici on supprime le message d'erreur personnalisé, et du coup mdp2 devient valide.
            document.getElementById('mdp2').setCustomValidity('');
        } else {
            // ici on ajoute un message d'erreur personnalisé, et du coup mdp2 devient invalide.
            document.getElementById('mdp2').setCustomValidity('Les mots de passes doivent être égaux.');
        }
    }

    computeAge = function(e) {
        try{
            // j'affiche dans la console quelques objets javascript, ce qui devrait vous aider.
            var dateAuj = Date.now();
            var dateAnniv = Date.parse(document.getElementById("birthdate").valueAsDate);
            age = dateAuj - dateAnniv;
            age=age/31536000000;
            age = age-((age/4)*0.0027322404371585);
            document.getElementById("age").value = Math.floor(age);
//                        console.log(new Date(0).getYear());
//                        console.log(new Date(65572346585).getYear());
            // modifier ici la valeur de l'élément age
        } catch(e) {
            // supprimez ici la valeur de l'élément age
            document.getElementById("age").value = "";
        }
    }

    loadProfilePic = function (e) {
        // on récupère le canvas où on affichera l'image
        var canvas = document.getElementById("preview");
        var ctx = canvas.getContext("2d");
        // on réinitialise le canvas: on l'efface, et déclare sa largeur et hauteur à 0
        ctx.setFillColor="white";
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
                var MAX_HEIGHT = 96;

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
</header>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li> <a href="main.php">Accueil</a> </li>
                <li> <a href="inscription.php">Inscription</a> </li>
                <li> <a href="paint.php">Dessiner</a> </li>
            </ul>
                <form class="navbar-form navbar-right inline-form" action="logout.php" method="post" name="logout">
                    <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm" value="Se déconnecter">
                    </div>
                </form>
        </div>
    </nav>
</div>



<?php
session_start();
if(isset($_SESSION['email'])) {
    echo "<div class=\"container-fluid\"><div class=\"row\">
    <div class=\"col-sm-6 col-sm-offset-3\"><strong> Bonjour ". $_SESSION['prenom'] .  "</strong></div>";
    echo "<div class=\"col-sm-6 col-sm-offset-3\"><img src='".$_SESSION['profilepic']."' width=300 height=400 alt='imagedeprofile'/> </div> </div></div>";
}
else {
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="req_login.php" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="email" name="mail" id="mail" tabindex="1" class="form-control" placeholder="Email" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="pwd" id="pwd" tabindex="2" class="form-control" placeholder="Mot de passe">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>

                            </form>


                            <form id="register-form" action="req_inscription.php" method="post" role="form" style="display: none;">
                                <span class="required_notification">Les champs obligatoires sont indiqués par *</span>
                                <div class="form-group">
                                        <label for="email">E-mail :</label>
                                        <input class="form-control" type="email" name="email" id="email" autofocus required/>
                                        <span class="form_hint">Format attendu "name@something.com"</span>
                                </div>
                                <div class="form-group">
                                        <label for="mdp1">Mot de passe :</label>
                                        <input class="form-control" type="password" name="password" id="mdp1" pattern="[A-Za-z0-9]{6,8}" onkeyup="validateMdp2()"  title = "Le mot de passe doit contenir de 6 à 8 caractères alphanumériques." placeholder="Indiquez votre mot de passe" required>

                                        <span class="form_hint">De 6 à 8 caractères alphanumériques.</span>
                                </div>

                                <div class="form-group">
                                        <label for="mdp2">Confirmez mot de passe :</label>
                                        <input class="form-control" type="password" id="mdp2" required onkeyup="validateMdp2()" placeholder="Les mots de passes doivent être identiques" required>
                                        <span class="form_hint">Les mots de passes doivent être égaux.</span>

                                </div>

                                <div class="form-group">
                                        <label for="birthdate">Date de naissance:</label>
                                        <input class="form-control" type="date" name="birthdate" id="birthdate" placeholder="JJ/MM/AAAA" required onchange="computeAge()"/>

                                        <span class="form_hint">Format attendu "JJ/MM/AAAA"</span>
                                </div>

                                <div class="form-group">
                                        <label for="age">Age:</label>
                                        <input class="form-control" type="number" name="age" id="age" disabled/>
                                </div>

                                <div class="form-group">
                                        <label for="profilepicfile">Photo de profil:</label>
                                        <input type="file" id="profilepicfile" onchange="loadProfilePic(this)"/>

                                        <span class="form_hint">Choisissez une image.</span>
                                        <input type="hidden" name="profilepic" id="profilepic"/>

                                        <canvas id="preview" width="0" height="0"></canvas>

                                </div>

                                <div class="form-group">
                                        <label for="prenom">Prénom :</label>
                                        <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Quel est ton prénom?" required />
                                </div>

                                <div class="form-group">
                                                        <label for="nom">Nom :</label>
                                        <input class="form-control" type="text" name="nom" id="prenom" />
                                </div>

                                <div class="form-group">
                                        <label for="tel">Numéro de téléphone :</label>
                                        <input class="form-control" type="tel" name="tel" id="tel" />
                                </div>

                                <div class="form-group">
                                        <label for="website">Site web :</label>
                                        <input class="form-control" type="url" name="website" id="website" />
                                </div>

                                <div class="form-group">
                                        <label for="sexe">Sexe :</label>
                                        <input class="form-control" type="radio" name="sexe" value="Homme" id="homme" /> Homme
                                        <input class="form-control" type="radio" name="sexe" value="Femme" id=femme" /> Femme
                                </div>

                                <div class="form-group">
                                        <label for="ville">Ville :</label>
                                        <input class="form-control" type="text" name="ville" id="ville" />
                                </div>

                                <div class="form-group">
                                        <label for="taille">Taille :</label>
                                        <input class="form-control" type="range" value="1,25" name="taille" id="taille" max="2,50" min="0" step="0,01" />
                                </div>

                                <div class="form-group">
                                        <label for="couleur">Couleur préférée :</label>
                                        <input class="form-control" type="color" name="couleur" id="couleur" value="#000000"/>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input class="form-control" type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

