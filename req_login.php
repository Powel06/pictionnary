<?php

$login = stripslashes($_POST['mail']);
$mdp = stripslashes($_POST['pwd']);

try {
    // Connect to server and select database.
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');

    // Vérifier si un utilisateur avec cette adresse email existe dans la table.
    // En SQL: sélectionner tous les tuples de la table USERS tels que l'email est égal à $email.
    $sql = $dbh->query("SELECT * FROM USERS WHERE email='".$login."' and password= '".$mdp."'");
    if ($sql->rowCount()>=1) {
        session_start();
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
                    Header("Location: main.php");
        }
    } else {
        Header("Location : main.php?erreur=".urlencode("L'email et/ou le mot de passe est deja utilisé"));
    }
    
}    
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}
?>