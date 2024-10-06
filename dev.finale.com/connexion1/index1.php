<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
     <form action="login.php" method="post">
     	<h2>Connnexion</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Email</label>
     	<input type="email" name="email" placeholder="votre email" required ><br>

     	<label>Mot de passe</label>
     	<input type="password" name="password" placeholder="votre mot de passe" required ><br>

     	<button type="submit" name="submit">Connexion</button>
          <a href="signup.php" class="ca">Inscriez-vous</a>
     </form>
	 <a href="../index.php" class="ca" >Retour a l'accueil</a>
</body>
</html>
