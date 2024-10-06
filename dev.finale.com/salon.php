<?php 
 include_once "session.php";
 init_session();
  include 'includes/navbar.php';?>

<div class="album py-5 bg-light"  style="margin-top:30px">
    <div class="container">
    <style type="text/css">
		 header{
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
				}
			h1{
				font-size: 40px;
				max-width: 800px;
				text-align: center;
				text-shadow: 5px 7px 3px #c8c8c0;
                color:#6c757d;
			} 
        </style>
    <header>
        <h1> Salons  </h1>
    </header>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php
                    require'admin/database.php';
                    $db=Database::connect();
                    $statement= $db-> query('SELECT * FROM itemsmini WHERE itemsmini.category = 4');
                    $produits = $statement->fetchAll();
                    foreach($produits as $produit)
                    {  ?>  
                        <div class="col">
                                <div class="card shadow-sm">
                                    <img src="online mini/<?= $produit['image']; ?>" style="height: 200px;">
                                    <h5 class="text-center mt-2"  ><?= $produit['name'] ?></h5>

                                    <div class="card-body">
                                    <p class="card-text"><?= substr($produit['description'], 0, 70); ?>...</p>
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
      </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>