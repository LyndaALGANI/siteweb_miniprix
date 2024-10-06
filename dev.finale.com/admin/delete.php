<?php
    require'database.php';
    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }
    if(!empty($_POST))
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM itemsmini WHERE id = ?");
        $statement->execute(array($id));
        header("Location: index.php");
    }
    function checkInput($data)
        {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"> </script>
    <link href='http://fonts.googlapis.com/css?family=holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
    <title>pageadmin</title>
</head>
<body>
    <div class="container ">
    <h1><span>mini</span> prix</h1>
    <div class="container admin">
     <div class="row">
      
       <h2> <strong> Supprimer un item</strong> </h2>
       <br>
       <form class="form" role="form" action="delete.php" method="post">
           <input type="hidden" name="id" value="<?php echo $id;?>"/>
       <p class="alert alert-warning"> Etes vous sur de vouloir supprimer ?</p>
       <div class="form-actions">
              <button type="submit" class="btn btn-warning">Oui</button>
              <a class="btn btn-default" href="index.php"> Non </a>
       </div>
    </form>
      </div>
     </div>   
    </div>
</body>
</html>