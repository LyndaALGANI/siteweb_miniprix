<?php
    include_once "../session.php";

init_session();

if ($_SESSION['email'] =="" || $_SESSION == "") {
    header('Location: ../connexion1/index1.php ');
}
if ($_SESSION['email'] != 'moh@gmail.com') {
    header('Location: ../index.php');
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
        <div class="admin">
            <div class="row">
                <h2><strong>Liste des items  </strong><a href="insert.php" class="btn btn-success btn-lg"><s class="glyphicon glyphicon-plus"></s>ajouter</a></h2>
                    <a href="../connexion1/logout.php" class="btn btn-success btn-lg" style="margin-left:750px">Deconnexion</a>
                <table class="table table-striped table-border">
                   <thead>
                      <tr>
                          <th>Nom</th>
                          <th>Description</th>
                          <th>Prix</th>
                          <th>Catégorie</th>
                          <th>Actions</th>
                      </tr>
                   </thead>
                   <tbody>
                       <?php
                       require'database.php';
                       $db=Database::connect();
                       $statement=$db->query('SELECT itemsmini.id, itemsmini.name, itemsmini.description, itemsmini.price,
                        categories.name AS category FROM itemsmini LEFT JOIN categories ON itemsmini.category= categories.id ORDER BY itemsmini.id DESC');
                       while($item=$statement->fetch())
                       {
                        echo'<tr>';
                        echo '<td>'.$item['name'].'</td>';
                        echo '<td>'.$item['description'].'</td>';
                        echo '<td>'. number_format((float) $item['price'],2,'.', '').'</td>';
                        echo '<td>'.$item['category'].'</td>';
    
                        echo '<td width=300>';
                            echo '<a class="btn btn-default" href="view.php?id='.$item['id'].'"><s class="glyphicon glyphicon-eye-open"></s> voir</a>';
                            echo' ';
                            echo '<a class="btn btn-primary" href="update.php?id='.$item['id'].'"><s class="glyphicon glyphicon-pencil"></s> modifier</a>';
                            echo' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$item['id'].'"><s class="glyphicon glyphicon-remove"></s> supprimer</a>';
                        echo  '</td>';
                        echo'</tr>';
                       }
                       ?>
                   </tbody>
                 
                </table>
 
            </div>
        </div>   
    </div>
</body>
</html>