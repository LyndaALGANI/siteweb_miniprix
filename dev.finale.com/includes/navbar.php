<?php include "fonctionsPanier.php" ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MiniPrix</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <style type="text/css">
        nav span{
        color: rgb(186, 135, 89);
        font-size: 30px;
        animation: flash 2s linear infinite;
        }
        @keyframes flash {
    0%{
        color: #198754;
        text-shadow: none;
    }
    100%{
        color: #a3dfab;
        text-shadow: 0 0 7px #f3f3bb, 0 0 50px #ff6c00;
    }
    
}
    </style>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php"><span>Mini</span> Prix</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item active">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="nouveaute.php">Nouveauté</a></li>
            <li class="nav-item"><a class="nav-link" href="chambre.php">Chambre</a></li>
            <li class="nav-item"><a class="nav-link" href="salon.php">Salon</a></li>
            <li class="nav-item"><a class="nav-link" href="table.php">Table</a></li>
            <li class="nav-item"><a class="nav-link" href="accessoires.php">Accessoires</a></li>
        </ul>
        <form class="d-flex ">
            <?php if(!$_SESSION) {
            
                ?>
                <a style="margin-right:4px"class="btn btn-success btn-lg" href="connexion1/index1.php">Connexion</a>

                <?php } else{?>   
                <a style="margin-right:4px"class="btn btn-success btn-lg"href="connexion1/logout.php">Deconnexion</a>
                <a href="panier2.php" style="text-decoration:none;color:black ;" class="btn btn-outline-primary mr-2" type="submit">
                <i class="bi-cart-fill me-1"></i>Chart
                <span  class="badge bg-dark text-white ms-1 rounded-pill"><?php  echo compterArticles(); ?></span>
                </a>                
            </button> 
            <?php }?>
        </form>
    </div>
  </div>
</nav>

</body>
</html>
