 <?php 
     include_once "session.php";
    init_session();
  
    include 'includes/navbar.php'; 

 ?>

<!-- Header-->
<div id="demo" class="carousel slide mt-4" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img height="550" src="img/slides.jpg" alt="Los Angeles" class="d-block" style="width:100%">
        </div>
        <div class="carousel-item">
            <img height="550" src="img/slide2.jpg" alt="Chicago" class="d-block" style="width:100%">
        </div>
        <div class="carousel-item">
            <img height="550" src="img/slide3.jpg" alt="New York" class="d-block" style="width:100%">
        </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
<!-- Section produit -->
<div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php
                    require'admin/database.php';
                    $db=Database::connect();
                    $statement= $db-> query('SELECT * FROM categories');
                    $categories = $statement->fetchAll();
                    foreach($categories as $category)
                    {  ?>     
                    <?php $statement = $db->prepare('SELECT * FROM itemsmini WHERE itemsmini.category = ?');
                        $statement -> execute(array($category['id']));
                        while($produit = $statement->fetch())
                        { ?> 
            <div class="col">
            <div class="card shadow-sm">
                <img src="online mini/<?= $produit['image']; ?>" style="height: 200px;">
                <h5 class="text-center mt-2"> <?= $produit['name'] ?></h5>

                <div class="card-body">
                <p class="card-text"><?= substr($produit['description'], 0, 40); ?>...</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <a href="detail_produit.php?pdt=<?= $produit['id'] ?>"><button type="button" class="btn btn-sm btn-success">Voir plus</button></a>
                    </div>
                    <small class="text" style="font-weight: bold;"><?= $produit['price'] ?> DA</small>
                </div>
                </div>
            </div>
            </div>
        <?php }?>
    <?php }?>
      </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
</body>

</html>