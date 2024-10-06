<?php
require'database.php';
$nameError= $descriptionError=$priceError=$categoryError=$imageError=$name=$description=$price=$category=$image="";
if(!empty($_POST))
{
  $name =checkInput($_POST['name']);
  $description =checkInput($_POST['description']);
  $price =checkInput($_POST['price']);
  $category =checkInput($_POST['category']);
  $image =checkInput($_FILES['image']['name']);
  $imagePath='../online mini/' .basename($image);
  $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
  $isSuccess = true;
  $isUploadSuccess = false;

  if(empty($name))
  {
    $nameError = 'ce champ ne peut pas etre vide';
    $isUploadSuccess = false;
  }
  if(empty($description))
  {
    $descriptionError = 'ce champ ne peut pas etre vide';
    $isUploadSuccess = false;
  }
  if(empty($price))
  {
    $priceError = 'ce champ ne peut pas etre vide';
    $isUploadSuccess = false;
  }
  if(empty($category))
  {
    $categoryError = 'ce champ ne peut pas etre vide';
    $isUploadSuccess = false;
  }
  if(empty($image))
  {
    $imageError = 'ce champ ne peut pas etre vide';
    $isUploadSuccess = false;
  }

  else{
    $isUploadSuccess = true;
    if($imageExtension !="jpg" && $imageExtension !="png" && $imageExtension !="gif")
    {
      $imageError = "les fichiers autorisés sont: .jpg .jpeg .png .gif";
      $isUploadSucess = false;
    }
     

  
    if($_FILES["image"]["size"]> 500000)
    {
      $imageError = "le fichier ne doit pas depasser les 500KB";
      $isUploadSuccess = false;

    }
    if ($isUploadSuccess)
    {
      if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
      {
        $imageError = "Il y a eu une erreur lors de l'upload";
        $isUploadSuccess = false;
      }
    }
  }
  if($isSuccess && $isUploadSuccess)
  {
    $db = Database::connect();
    $statement = $db-> prepare("INSERT INTO itemsmini(name,description,price,category,image) values(?, ?, ?, ?, ?)");
    $statement->execute(array($name,$description,$price,$category,$image));
    Database::disconnect();
    header("Location: index.php");
  }
   
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
       <h2> <strong> Ajouter un item</strong> </h2>
       <br>
       <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
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
                   echo'<option value="'. $row['id'] .'">' . $row['name'] .'</option>';
                 }
                ?>
              </select>
              <h4 class="help-inline"><?php echo $categoryError; ?> </h4>
            </div>
            <div class="form-group">
              <label for="image">Selectionner une Image</label>
              <input type="file" id="image" name="image">
              <h4 class="help-inline"><?php echo $imageError;?><h4>
            </div>
       
            <div class="form-actions">
              <button type="submit" class="btn btn-success"><h4 class="glyphicon glyphicon-pencil"></h4>Ajouter</button>
              <a class="btn btn-primary" href="index.php"><h4 class="glyphicon glyphicon-arrow-left"> </h4> Retour </a>
            </div>
            </form>
      </div>   
        
     </div>   
    </div>
</body>
</html>