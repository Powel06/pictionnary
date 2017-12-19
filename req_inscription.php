<?php

// récupérer les éléments du formulaire
// et se protéger contre l'injection MySQL (plus de détails ici: http://us.php.net/mysql_real_escape_string)
error_reporting(0);
$email=stripslashes($_POST['email']);
$password=stripslashes($_POST['password']);
$nom=stripslashes($_POST['nom']);
$prenom=stripslashes($_POST['prenom']);
$tel=stripslashes($_POST['tel']);
$website=stripslashes($_POST['website']);
$sexe='';
if (array_key_exists('sexe',$_POST)) {
    $sexe=stripslashes($_POST['sexe']);
}
$birthdate=stripslashes($_POST['birthdate']);
$ville=stripslashes($_POST['ville']);
$taille=stripslashes($_POST['taille']);
$couleur=stripslashes($_POST['couleur']);
$profilepic=stripslashes($_POST['profilepic']);

try {
    // Connect to server and select database.
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');

    // Vérifier si un utilisateur avec cette adresse email existe dans la table.
    // En SQL: sélectionner tous les tuples de la table USERS tels que l'email est égal à $email.
    $sql = $dbh->query("SELECT * FROM USERS WHERE email='".$email."'");
    if ($sql->rowCount()>=1) {
        Header("Location: req_login");
        // rediriger l'utilisateur ici, avec tous les paramètres du formulaire plus le message d'erreur
        // utiliser à bon escient la méthode htmlspecialchars http://www.php.net/manual/fr/function.htmlspecialchars.php          // et/ou la méthode urlencode http://php.net/manual/fr/function.urlencode.php
    }
    else { 
        // Tenter d'inscrire l'utilisateur dans la base
        $sql = $dbh->prepare("INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) "
            . "VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profilepic)");
        $sql->bindValue(":email", $email);
        // de même, lier la valeur pour le mot de passe
        $sql->bindValue(":password", $password);
        // lier la valeur pour le nom, attention le nom peut être nul, il faut alors lier avec NULL, ou DEFAULT  
        if($nom != null || $nom != "")
            $sql->bindValue(":nom", $nom);
        else
            $sql->bindValue(":nom", NULL);
        // idem pour le prenom, tel, website, birthdate, ville, taille, profilepic  
        if($prenom != null || $prenom != "")
            $sql->bindValue(":prenom", $prenom);
        else
            $sql->bindValue(":prenom", NULL);

        if($tel != null || $tel != "")
            $sql->bindValue(":tel", $tel);
        else
            $sql->bindValue(":tel", NULL);

        if($website != null || $website != "")
            $sql->bindValue(":website", $website);
        else
            $sql->bindValue(":website", NULL);

        if($birthdate != null || $birthdate != "")
            $sql->bindValue(":birthdate", $birthdate);
        else
            $sql->bindValue(":birthdate", NULL);

        if($ville != null || $ville != "")
            $sql->bindValue(":ville", $ville);
        else
            $sql->bindValue(":ville", NULL);

        if($taille != null || $taille != "")
            $sql->bindValue(":taille", $taille);
        else
            $sql->bindValue(":taille", NULL);

        if($profilepic != null || $profilepic != "")
            $sql->bindValue(":profilepic", $profilepic);
        else
            $sql->bindValue(":profilepic", NULL);
        // n.b., notez: birthdate est au bon format ici, ce serait pas le cas pour un SGBD Oracle par exemple  
        // idem pour la couleur, attention au format ici (7 caractères, 6 caractères attendus seulement)  
        if($couleur != null || $couleur != "") {
            $couleur = str_replace('#', '', $couleur);
            $sql->bindValue(":couleur", $couleur);
        }
        else
            $sql->bindValue(":couleur", NULL);
        // idem pour le prenom, tel, website  
        // idem pour le sexe, attention il faut être sûr que c'est bien 'H', 'F', ou ''  
        if($sexe =="Homme")
            $sql->bindValue(":sexe", 'H');
        else
            $sql->bindValue(":sexe", 'F');

        // on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.
        if (!$sql->execute()) {
            echo "PDO::errorInfo():<br/>";
            $err = $sql->errorInfo();
            print_r($err);
        } else {
            // ici démarrer une session 
            session_start();
            // ensuite on requête à nouveau la base pour l'utilisateur qui vient d'être inscrit, et
            $sql = $dbh->query("SELECT u.id, u.email, u.nom, u.prenom, u.couleur, u.profilepic FROM USERS u WHERE u.email='".$email."'");
            if ($sql->rowCount()<1) {
                header("Location: main.php?erreur=".urlencode("un problème est survenu"));
            }
            else {
                // on récupère la ligne qui nous intéresse avec $sql->fetch(),   
                // et on enregistre les données dans la session avec $_SESSION["..."]=...  
                while($donnees = $sql->fetch()){
                    $_SESSION['email'] = $donnees['email'];
                    $_SESSION['nom'] = $donnees['nom'];
                    $_SESSION['prenom'] = $donnees['prenom'];
                    $_SESSION['tel'] = $donnees['tel'];
                    $_SESSION['website'] = $donnees['website'];
                    $_SESSION['birthdate'] = $donnees['birthdate'];
                    $_SESSION['ville'] = $donnees['ville'];
                    $_SESSION['taille'] = $donnees['taille'];
                    $_SESSION['profilepic'] = $donnees['profilepic'];
                    $_SESSION['couleur'] = $donnees['couleur'];
                    $_SESSION['sexe'] = $donnees['sexe'];
                }
            }
            // ici,  rediriger vers la page main.php
            header("Location: main.php");
        }
        $dbh = null;
    }
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}
?>