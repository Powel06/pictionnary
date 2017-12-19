<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pictionnary</title>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css" >
    <link href="css/starter-template.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" >
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<header>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Pictionnary</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="main.php">Accueil</a></li>
            <li><a href="inscription.php">S'inscrire</a></li>
            <li><a href="paint.php">Dessiner</a></li>
            <form class="navbar-form navbar-right inline-form" action="logout.php" method="post" name="logout">
            <input type="submit" class="btn btn-primary btn-sm" value="Se déconnecter">
          </form>
          </ul>
        </div>
      </div>
</nav>
</header>
<body>

<?php
error_reporting(0);
session_start();
if(isset($_SESSION['email'])) {
    echo "<p class=\"text-uppercase\"><strong> Bonjour ". $_SESSION['prenom'] .  "</strong>";
    echo "<img src='".$_SESSION['profilepic']."' width=300 height=400 alt='imagedeprofile'/>";
    ?><form action="logout.php" method="post" name="logout">
        <fieldset>
        <div class="form-group">
           <input type="submit" class="btn btn-md" value="Se déconnecter">  
       </div>
        </fieldset>
     </form>
<?php }

else {
	?>
    <hr>
    <div class="col-md-5">
	<form role="form" id="connect" action="req_login.php" method="post">
		<fieldset>
            <p class="text-uppercase"> Se connecter </p>  
            <div class="form-group">
        			<label for="email">Login :</label>
                	<input class="form-control input-lg" type="email" name="email" id="email" autofocus required/>
                	<span class="form_hint">Format attendu "name@something.com"</span>
            </div>
            <div class="form-group">            
            	<label for="mdp1">Mot de passe :</label>
            	<input type="password" name="pwd" class="form-control input-lg" id="pwd" placeholder="Entrer votre mot de passe">
            </div>
            <div class="form-group">
        	   <input type="submit" class="btn btn-md" name="login-submit" id="login-submit" value="Se connecter">
            </div>
        </fieldset>
    </form>
</div>
<div class="col-md-5">
    <form action="inscription.php" method="post">
        <fieldset>
             <div class="form-group">
                    <input type="submit" name="register-submit" class="form-control input-lg" id="register-submit" value="S'inscrire">
             </div>
        </fieldset>
</form>
</div>
    <?php
}
?>
</body>
</html>


