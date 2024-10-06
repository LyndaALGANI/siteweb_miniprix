<?php 
     include_once "session.php";
    init_session();

    include 'includes/navbar.php'; 


require_once 'admin/database.php';

if(!empty($_GET['pdt']))
{
  $id= checkInput($_GET['pdt']);

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
<style>
.bd-placeholder-img {
font-size: 1.125rem;
text-anchor: middle;
-webkit-user-select: none;
-moz-user-select: none;
user-select: none;
}

@media (min-width: 768px) {
.bd-placeholder-img-lg {
    font-size: 3.5rem;
}
}
</style>
<div class="album py-5 mt-4 bg-light">
<div class="container mt-4" >

<div class="row">
<div class="col-md-2"></div>
<?php //echo "<pre>";print_r($item);"</pre>"; die();?>
        <div class="col-md-8">
            <div class="card shadow-sm" >
                <h3 class="text-center"><?=  $item['name'];?></h3>
                <img src="<?= 'online mini/'.$item['image'] ; ?>" style="width: 100%">

                <div class="card-body" >
                <p class="card-text"><?= $item['description']; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">   
                    <?php
                    $type = 'a';
                     if(!$_SESSION) {
                        $type = 'p'; }
                    ?>
                    <<?php echo $type ?> href="panier2.php?action=ajout&amp;l=<?= $item['name']?>&amp;q=1&amp;p=<?=$item['price']?>&amp;">
                    
                    <button type="button" class="btn btn-sm btn-success" <?php if(!$_SESSION) {
                        echo 'disabled'; }?>
                    
                    
                    ><?php if($_SESSION) {
                        echo 'Commander'; }else {
                            echo 'veuillez vous connecter pour passer une commande';
                        } ?>
                            </button></<?php echo $type ?>>
                    </div>
                    <small class="text" style="font-weight: bold;"><?= number_format((float) $item['price'],2,'.', ''). ' DA'; ?></small>
                </div>
                </div>
            </div>
        </div>

<div class="col-md-2"></div>
    </div>
</div>
</div>
