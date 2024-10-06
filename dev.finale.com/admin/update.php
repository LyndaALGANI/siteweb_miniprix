<?php
require'database.php';
if(!empty($_GET['id']))
{
    $id = checkInput($_GET['id']);
}

$nameError= $descriptionError=$priceError=$categoryError=$imageError=$name=$description=$price=$category=$image="";
if(!empty($_POST))
{
  $name           =checkInput($_POST['name']);
  $description    =checkInput($_POST['description']);
  $price          =checkInput($_POST['price']);
  $category       =checkInput($_POST['category']);
  $image          =checkInput($_FILES['image']['name']);
  $imagePath      ='../online mini/' .basename($image);
  $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
  $isSuccess      = true;
 
  

  if(empty($name))
  {
    $nameError = 'ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  if(empty($description))
  {
    $descriptionError = 'ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  if(empty($price))
  {
    $priceError = 'ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  if(empty($category))
  {
    $categoryError = 'ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  if(empty($image))
  {
    $isImageUpdated = false;

  }

  else{
    $isImageUpdated = true; 
    $isUploadSuccess = true;
    if($imageExtension !="jpg" && $imageExtension !="png" && $imageExtension !="gif")
    {
      $imageError = "les fichiers autorisés sont: .jpg .jpeg .png .gif";
      $isSuccess = false;
    }
    
    if($_FILES["image"]["size"]> 500000)
    {
      $imageError = "le fichier ne doit pas depasser les 500KB";
      $isSuccess = false;

    }
    if ($isUploadSuccess)
    {
      if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
      {
        $imageError = "Il y a eu une erreur lors de l'upload";
        $isSuccess = false;
      }
    }
  }
  if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated))
  {
    $db = Database::connect();
    if($isImageUpdated)
    {
        $statement = $db-> prepare("UPDATE  itemsmini set name = ?, description = ?, price = ?, category = ?, image= ?  WHERE id = ? ");
        $statement->execute(array($name,$description,$price,$category,$image,$id));
    }
    else
    {
        $statement = $db-> prepare("UPDATE itemsmini set name = ?, description = ?, price = ?, category = ? WHERE id = ? ");
        $statement->execute(array($name,$description,$price,$category,$id));

    }
    header("Location: index.php");
  }
  else if($isImageUpdated && !$isUploadSuccess)
  {
        $db = Database::connect();
        $statement = $db->prepare("SELECT image FROM itemsmini where id=?");
        $statement->execute(array($id));
        $item = $statment->fetch();
        $image = $item['image'];
        Database::disconnect();
  }
   
}
else
{
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM itemsmini WHERE id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $name    =$item['name'];
    $decription   =$item['description'];
    $price    =$item['price'];
    $category    =$item['category'];
    $image    =$item['image'];

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
      <div class="col-sm-6">
       <h2> <strong> Modifier un item</strong> </h2>
       <br>
       <form class="form" role="form" action="<?php echo 'update.php?id=' . $id ; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name" > Nom: </label>
             <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
             <h4 class="help-inline"><?php echo $nameError; ?> </h4>
            </div>

            <div class="form-group">
              <label for="description"> Description: </label>
              <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
              <h4 class="help-inline"><?php echo $descriptionError; ?> </h4>
            </div>

            <div class="form-group">
              <label for="price"> Prix: </label>
              <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php  echo $price; ?>">
              <h4 class="help-inline"><?php echo $priceError; ?> </h4>

            </div>
            <div class="form-group">
              <label for="category"> Catégorie: </label>
              <select class="form-control" id="category" name="category">
                <?php
                 $db=Database::connect();
                 foreach($db->query('SELECT * FROM categories') as $row)
                 {
                     if($row ['id']== $category)
                      echo'<option selected="selected" value="'. $row['id'] .'">' . $row['name'] .'</option>';
                     else 
                      echo'<option value="'. $row['id'] .'">' . $row['name'] .'</option>';
                 }
                ?>
              </select>
              <h4 class="help-inline"><?php echo $categoryError; ?> </h4>
            </div>
            <div class="form-group">
              <label>Image:</label>
              <p><?php echo $image; ?></p>
              <label for="image">Selectionner une Image</label>
              <input type="file" id="image" name="image">
              <h4 class="help-inline"><?php echo $imageError;?><h4>
            </div>
       
            <div class="form-actions">
              <button type="submit" class="btn btn-success"><h4 class="glyphicon glyphicon-pencil"></h4>Modifier</button>
              <a class="btn btn-primary" href="index.php"><h4 class="glyphicon glyphicon-arrow-left"> </h4> Retour </a>
            </div>
            </form>
      </div> 
      <div>

      <div class="col-sm-6 site"> 
                    <div class="thumbnail">
                     <img width="450px" height="500px" src="<?php echo '../online mini/'.$image ;?>" alt="..">
                       <div class="price"> <?php echo number_format((float)$price,2, '.', '') .'DA' ;?> </div>
                         <div class="caption">
                            <h4><?php echo   $name; ?></h4>
                            <p> <?php echo   $description; ?> </p>  
                          </div>    
                        </div>   
                    </div> 
                </div>
                </div>
    </body>
</html>