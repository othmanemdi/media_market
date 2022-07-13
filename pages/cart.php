<?php

ob_start();
// php
$title = "Cart";


if (isset($_POST['panier_produits_delete'])) {

    $id = (int)$_POST['panier_produits_id'];
    $pdo->query("DELETE FROM panier_produits WHERE id = $id");
    $_SESSION['flash']['success'] = 'Bien supprimer';
    header('Location: cart');
    die();
}


// phpinfo();

// dd($_SERVER);
$ip_server = $_SERVER['SERVER_ADDR'];

$paniers = $pdo->query("SELECT 
pp.id AS panier_produits_id,
pr.id As produit_id,
pr.nom As produit_nom,
pp.qt AS panier_produits_qt,
pp.prix AS panier_produits_prix,
pr.ancien_prix

 FROM panier_produits pp
LEFT JOIN paniers p ON p.id = pp.panier_id 
LEFT JOIN products pr ON pr.id = pp.produit_id 
 WHERE p.ip = '$ip_server'
 ")->fetchAll();




$ip_server = IP_SERVER;

$prix_panier = $pdo->prepare("SELECT SUM(pp.prix) As prix_panier FROM paniers p 
    LEFT JOIN panier_produits pp ON pp.panier_id = p.id
    WHERE p.ip = :ip LIMIT 1 ");

$prix_panier->execute(['ip' => $ip_server]);

$order_summary = $prix_panier->fetch()->prix_panier ?? 0;

// dd($paniers);

$content_php = ob_get_clean();


ob_start(); ?>


<div class="row">
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paniers as $key => $p) : ?>
                        <?php
                        $image = $pdo->query("SELECT nom FROM product_images WHERE product_id = $p->produit_id and ranking = 1 LIMIT 1;")->fetch();
                        $image = $image->nom ?? "1.jpg";

                        ?>
                        <tr>
                            <td>
                                <img src="images/products/<?= $image  ?>" width="50" alt="">
                            </td>
                            <td> <?= strtoupper($p->produit_nom) ?></td>

                            <td>
                                <input type="number" class="form-control w-50" value="<?= $p->panier_produits_qt ?>">
                            </td>
                            <td>
                                <span class="fw-bold me-2">$<?= $p->panier_produits_prix ?></span>
                                <small> <del class="text-danger">$<?= $p->ancien_prix ?></del></small>
                            </td>
                            <td>




                                <button type="button" class="btn btn-link text-danger" data-bs-toggle="modal" data-bs-target="#couleur_delete_<?= $p->panier_produits_id ?>">
                                    <i class="far fa-trash-alt"></i>
                                </button>


                                <div class="modal fade" id="couleur_delete_<?= $p->panier_produits_id ?>" tabindex="-1" aria-labelledby="label_<?= $p->panier_produits_id ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="label_<?= $p->panier_produits_id ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Supprimer
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-danger fw-bold h5"> Voulez vous vraiment supprimer <?= strtoupper($p->produit_nom) ?> ?</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-undo"></i>
                                                    Retour
                                                </button>

                                                <form method="post" style="display: inline;">
                                                    <input type="hidden" name="panier_produits_id" value="<?= $p->panier_produits_id ?>">
                                                    <button name="panier_produits_delete" type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </td>
                        </tr>
                    <?php endforeach  ?>


                </tbody>
            </table>

        </div>


    </div>

    <div class="col-md-4">
        <h3>Payement Summary</h3>

        <div class="p-3 bg-light">
            <div class="d-flex mb-3">
                <div class="me-auto p-2">
                    <input type="text" class="form-control" placeholder="COUPON CODE">
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-info fw-bold text-white">Apply</button>
                </div>
            </div>

            <ul class="bg-transparent list-group">
                <li class="bg-transparent list-group-item d-flex justify-content-between align-items-start">

                    <div class="ms-2 me-auto">

                        <div class="fw-bold">Order Summary:</div>

                    </div>

                    <span class="badge bg-dark rounded-pill"> <?= _numbrer_format($order_summary) ?></span>

                </li>



            </ul>

            <a href="proced_checkout" class="btn btn-info fw-bold text-white mt-3 rounded-pill">
                PROCED TO CHECKOUT
            </a>
        </div>



    </div>
</div>



<?php $content_html = ob_get_clean(); ?>