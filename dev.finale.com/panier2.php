<?php 
include_once "session.php";
init_session();
include'includes/navbar.php';


$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
    if(!in_array($action,array('ajout', 'suppression', 'refresh')))
        $erreur=true;

    //récupération des variables en POST ou GET
    $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
    $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
    $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
    $i = (isset($_POST['i'])? $_POST['i']:  (isset($_GET['i'])? $_GET['i']:null )) ;


    //Suppression des espaces verticaux
    $l = preg_replace('#\v#', '',$l);
    //On vérifie que $p est un float
    $p = floatval($p);

    //On traite $q qui peut être un entier simple ou un tableau d'entiers

    if (is_array($q)){
        $QteArticle = array();
        $i=0;
        foreach ($q as $contenu){
            $QteArticle[$i++] = intval($contenu);
        }
    }
    else
        $q = intval($q);

}

if (!$erreur){
    switch($action){
        Case "ajout":
            ajouterArticle($l,$q,$p);
            break;

        Case "suppression":
            supprimerArticle($l);
            break;

        Case "refresh" :
            for ($i = 0 ; $i < count($QteArticle) ; $i++)
            {
                modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
            }
            break;

        Default:
            break;
    }
}



?>
<div class="container mt-5">
    <div class="row py-5 mt-4">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
        if (creationPanier())
        {
            $nbArticles=count($_SESSION['panier']['libelleProduit']);
            if ($nbArticles <= 0)
                echo "<tr><td>Votre panier est vide </ td></tr>";
            else
            {
                for ($i=0 ;$i < $nbArticles ; $i++)
                {
                    echo "<tr>";
                    echo '<td></td>';
                    echo '<td><img width="150" src="online mini/bois.jpg"/> </td>"';
                    echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
                    echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                    echo '<td class="text-right"'."><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i])).'><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button></a></td>';
                    echo "</tr>";
                }

                echo "</td></tr>";
            }
        }
        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Net-a-payé</td>
                            <td class="text-right"><?php echo MontantGlobal() ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-lg btn-block btn-success text-uppercase" ><a href="index.php"  style=" color:white; text-decoration:none">Continue Shopping</a></button>
                </div>
                <?php if (MontantGlobal()>0) {?>
                    <div class="col-sm-12 col-md-6 text-right">
                        <button class="btn btn-lg btn-block btn-success text-uppercase" style="margin-left:400px;"><a href="confirme.php" style=" color:white; text-decoration:none">Confirmer</a></button>
                    </div>
                </div>
                
            <?php
            }
            ?>
        </div>
    </div>
</div>
