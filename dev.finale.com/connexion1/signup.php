<!--<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
     <form action="signup_chek.php" method="post">
     	<h2>Inscription</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>


          <label>Pseudo</label>
          <input type="text" name="pseudo" placeholder="votre pseudo"><br>
          

          <label>Email</label>
          <input type="text" name="email" placeholder="Email"><br>
         
     	<label>Mot de passe</label>
     	<input type="password" name="password" placeholder="Votre mot de passe"><br>

          <label>Retape Mot de passe</label>
          <input type="password" name="re_password" placeholder="Confirmer votre mot de passe"><br>

     	<button type="submit">Inscription</button>
          <a href="index1.php" class="ca">vous avez un compte ?</a>
     </form>
</body>
</html>-->
<?php

include "config.php";
include "function.php";

// if(isset($_SESSION['userxXJppk45hPGu']))
// {
//     if(!empty($_SESSION['userxXJppk45hPGu']))
//     {
//         header("Location: client/");
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login - MonoShop</title>
</head>
<body>
<div class="container mt-5 py-4">
<h2 class="text-center">Inscription</h2>
</div>

<div class="container" >
     <div class="row">
          <div class="col-md-2"></div>
        <div class="col-md-8">

          <form method="post">
               <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="name" name="nom" class="form-control" required placeholder="Nom" >
               </div>
               <div class="mb-3">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="name" name="prenom" class="form-control" required placeholder="Prénom" >
               </div>
               <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="E-mail" >
               </div>
               <div class="mb-3">
                    <label for="adresse" class="form-label">adresse</label>
                    <input type="adresse" name="adresse" class="form-control" required placeholder="adresse" >
               </div>
               <div class="mb-3">
                    <label for="telephone" class="form-label">Télephone</label>
                    <input type="telephone" name="telephone" class="form-control" required placeholder="Télephone" >
               </div>
               <div class="mb-3">
                    <label for="motdepasse" class="form-label">Mot de passe</label>
                    <input type="password" name="motdepasse" class="form-control" required placeholder="Mot de passe">
               </div>
               <br>
               <input type="submit" name="envoyer" class="btn btn-primary float-end" value="Envoyer">
               <a  href="../index.php" class="ca float-left" style=" color:black " >Retour à l'accueil</a>
          </form>   

        </div>
        <div class="col-md-2"></div>
    </div>
</div>
    
</body>
</html>

<?php

if(isset($_POST['envoyer']))
{
    if(!empty($_POST['email']) AND !empty($_POST['motdepasse']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['adresse']) AND !empty($_POST['telephone']))
    {    
        $email = htmlspecialchars(strip_tags($_POST['email'])) ;
        // $motdepasse = password_hash( $_POST['motdepasse'],PASSWORD_DEFAULT); 
        $motdepasse = htmlspecialchars(strip_tags($_POST['motdepasse']));
        $nom = htmlspecialchars(strip_tags($_POST['nom']));
        $prenom = htmlspecialchars(strip_tags($_POST['prenom']));
        $adresse  = htmlspecialchars(strip_tags($_POST['adresse']));
        $telephone = htmlspecialchars(strip_tags($_POST['telephone']));
       

        $user = ajouterUsers($nom, $prenom, $email, $adresse, $telephone, $motdepasse);

        if($user){
          
            
            header('Location: index1.php?success=Success!');
        }else{
            echo "Compte non créer !";
        }
      
          
       }
    }



?>