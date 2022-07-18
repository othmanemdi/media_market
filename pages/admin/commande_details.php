<?php

ob_start();
// php
$title = "Commande details";


if (!isset($_GET['id'])) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: commandes');
    die();
}
$commande_id = (int)$_GET['id'];

if ($commande_id == 0) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: commandes');
    die();
}


$commande_details = $pdo->query("SELECT 
c.id As numero, 
c.date_commande,
u.prenom,
u.nom, 
u.telephone,
u.adresse,
u.ville,
u.email

FROM commandes c 
LEFT JOIN users u ON u.id = c.user_id
WHERE c.id = $commande_id
;")->fetch();




$produits_commande = $pdo->query("SELECT 
pr.id As produit_id,
pr.nom As produit_nom,
cp.qt,
cp.prix

FROM commande_produits cp
LEFT JOIN commandes c ON c.id = cp.commande_id 
LEFT JOIN products pr ON pr.id = cp.produit_id 
WHERE cp.commande_id = $commande_id 
")->fetchAll();
$content_php = ob_get_clean();

$totale_prix = 0;

ob_start(); ?>

<h3>Commande details</h3>


<div class="card shadow mb-3">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Commande N°:</dt>
            <dd class="col-sm-9">
                <?= $commande_details->numero ?>
            </dd>

            <dt class="col-sm-3">Date de Commande</dt>
            <dd class="col-sm-9">
                <?= $commande_details->date_commande ?>
            </dd>

            <dt class="col-sm-3">Client</dt>

            <dd class="col-sm-9"><?= ucfirst($commande_details->prenom . " " . $commande_details->nom)  ?></dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">
                <?= $commande_details->email ?>
            </dd>

            <dt class="col-sm-3">Telephone</dt>
            <dd class="col-sm-9">
                <?= $commande_details->telephone ?>
            </dd>

            <dt class="col-sm-3">Adresse</dt>
            <dd class="col-sm-9">
                <?= $commande_details->adresse ?>
            </dd>

            <dt class="col-sm-3">Ville</dt>
            <dd class="col-sm-9">
                <?= $commande_details->ville ?>
            </dd>

        </dl>


        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits_commande as $key => $p) : ?>
                        <?php
                        $image = $pdo->query("SELECT nom FROM product_images WHERE product_id = $p->produit_id and ranking = 1 LIMIT 1;")->fetch();
                        $image = $image->nom ?? "1.jpg";

                        // $totale_prix = $totale_prix + $p->prix;
                        $totale_prix += $p->prix;

                        ?>
                        <tr>
                            <td>
                                <img src="../images/products/<?= $image  ?>" width="30" alt="">
                            </td>
                            <td> <?= $p->produit_nom ?></td>

                            <td>
                                <?= $p->qt ?>
                            </td>
                            <td>
                                <span class="fw-bold me-2"> <?= _numbrer_format($p->prix) ?> DH</span>
                            </td>

                        </tr>
                    <?php endforeach  ?>


                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="3">Total:</th>
                        <th>
                            <?= _numbrer_format($totale_prix) ?> DH
                        </th>
                    </tr>
                </tfoot>
            </table>



        </div>
        <div class="row mt-3">
            <div class="col-md-7">

            </div>

            <div class="col-md-5">
                <table class="table table-sm table-bordered">
                    <tr>
                        <th>Total:</th>
                        <th>
                            <?= _numbrer_format($totale_prix) ?> DH
                        </th>
                    </tr>
                    <tr>
                        <th>Remise: </th>
                        <th>10 000.00 DH</th>
                    </tr>

                    <tr>
                        <th>Prix: TTC</th>
                        <th>849 949.00 DH</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $content_html = ob_get_clean(); ?>