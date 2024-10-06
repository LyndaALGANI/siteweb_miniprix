<?php 
require 'database.php';
if(!empty($_GET['id']))
{
  $id= checkInput($_GET['id']);

}
$db = Database::connect();
$statement = $db-> prepare('SELECT itemsmini.id, itemsmini.name, itemsmini.description, itemsmini.price, itemsmini.image,
categories.name AS category FROM itemsmini LEFT JOIN categories ON itemsmini.category= categories.id WHERE itemsmini.id = ?');
$statement -> execute(array($id));
$item = $statement-> fetch();

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
                     <div class="col-sm-6">
                        <h2> <strong> Voir un item</strong> </h2>
                        <br>
                            <form>
                              <div class="form-group">
                                <label> Nom: </label><?php echo '   ' . $item['name']; ?>
                              </div>
                              <div class="form-group">
                                <label> Description: </label><?php echo '   ' . $item['description']; ?>
                              </div>
                              <div class="form-group">
                                <label> Prix: </label><?php echo '   ' .number_format((float) $item['price'],2,'.', ''). ' DA'; ?>
                              </div>
                              <div class="form-group">
                                <label> Catégorie: </label><?php echo '   ' . $item['category']; ?>
                              </div>
        
                              <div class="form-actions">
                                  <a class="btn btn-primary" href="index.php"><btn class="glyphicon glyphicon-arrow-left"> </btn> Retour </a>
                              </div>
                            </form>
                      </div> 
                      <div class="col-sm-6 site"> 
                         <div class="thumbnail" >
                           <img width="450px" height="100px" src="<?php echo '../online mini/'.$item['image'] ;?>" alt="..">
                             <div class="price"> <?php echo number_format((float)$item['price'],2, '.', '') .'DA' ;?> </div>
                               <div class="caption">
                                  <h4><?php echo   $item['name']; ?></h4>
                                  <p> <?php echo   $item['description']; ?> </p>  
                               </div>    
                             </div>   
                         </div> 
                      </div>
         </div>
    </body>
</html>