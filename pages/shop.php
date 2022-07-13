<?php

ob_start();
// php
$title = "Shop";

if (isset($_POST['add_to_cart'])) {
    $ip_server = IP_SERVER;
    $produit_id = (int)$_POST['produit_id'];
    $prix = (float)$_POST['prix'];

    $paniers = $pdo->query("SELECT id FROM paniers WHERE ip = '$ip_server' LIMIT 1")->fetch();

    if (!$paniers) {
        $panier = $pdo->prepare("INSERT INTO paniers SET ip = :ip");
        $panier->execute(
            ['ip' => $ip_server]
        );
        $panier_id = $pdo->lastInsertId();
    } else
        $panier_id = $paniers->id;

    $check_product_if_exist = $pdo->prepare("SELECT id FROM panier_produits
    WHERE panier_id  = :panier_id AND produit_id = :produit_id LIMIT 1");

    $check_product_if_exist->execute(['panier_id' => $panier_id, 'produit_id' => $produit_id]);

    if ($check_product_if_exist->fetch()) {
        // echo "Update";
        $panier_produits = $pdo->prepare("UPDATE panier_produits 
                SET
                qt = qt + 1
                WHERE panier_id = :panier_id AND produit_id = :produit_id
        ");
        $panier_produits->execute(
            [
                'panier_id' => $panier_id,
                'produit_id' => $produit_id,
            ]
        );
    } else {
        // echo "Add";

        $panier_produits = $pdo->prepare("INSERT INTO panier_produits 
            SET
            panier_id = :panier_id,
            produit_id = :produit_id,
            prix = :prix
     ");
        $panier_produits->execute(
            [
                'panier_id' => $panier_id,
                'produit_id' => $produit_id,
                'prix' => $prix
            ]
        );
    }

    $_SESSION['flash']['success'] = 'Bien ajouter';
    header('Location: cart');
    die();
}










$products = $pdo->query("SELECT 
    p.id As product_id,
    p.nom As product_nom,
    p.reference,
    p.prix,
    p.ancien_prix,
    m.nom As marque_nom,
    c.nom As categorie_nom,
    cr.nom As couleur_nom,
    p.activated

    FROM products p

        LEFT JOIN marques m ON m.id = p.marque_id
        LEFT JOIN categories c ON c.id = p.categorie_id
        LEFT JOIN couleurs cr ON cr.id = p.couleur_id
    WHERE p.activated = 1
  ORDER BY p.id DESC;")->fetchAll();






// $products = glob('images/products/*.jpg');

// $couleurs = [];
// $couleurs[] = "Gray";
// $couleurs[] = "Brown";
// $couleurs[] = "Black";
// $couleurs[] = "Blue";
// $couleurs[] = "Yellow";
// $couleurs[] = "Red";
// $couleurs[] = "Green";
// $couleurs[] = "Pink";
// $couleurs[] = "Purple";
// $couleurs[] = "Orange";
// $couleurs[] = "White";



$marques = $pdo->query("SELECT * FROM marques ")->fetchAll();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$couleurs = $pdo->query("SELECT * FROM couleurs ")->fetchAll();


$content_php = ob_get_clean();

ob_start(); ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Shop</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-3 col-md-4">
        <div class="sticky-sm-top">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item mb-0 border-0 ronded mb-3">
                    <h2 class="accordion-header" id="headingZero">
                        <button class="accordion-button p-0 px-4 py-1 bg-transparent text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                            <div class="fw-bold h5 text-dark">MARQUES</div>
                        </button>
                    </h2>
                    <div id="collapseZero" class="accordion-collapse collapse show" aria-labelledby="headingZero">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($marques as $key => $m) : ?>
                                    <li class="list-group-item text-uppercase">
                                        <?= strtoupper($m->nom) ?>
                                    </li>
                                <?php endforeach  ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-0 border-0 ronded mb-3">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button p-0 px-4 py-1 bg-transparent text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="fw-bold h5 text-dark">CATÉGORIE</div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($categories as $key => $m) : ?>
                                    <li class="list-group-item text-uppercase">
                                        <?= strtoupper($m->nom) ?>
                                    </li>
                                <?php endforeach  ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-0 border-0 ronded mb-3">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed p-0 px-4 py-1 bg-transparent text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="fw-bold h5 text-dark">FAMILLE DE COULEURS</div>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                        <div class="accordion-body">


                            <div class="row">
                                <?php foreach ($couleurs as $key => $m) : ?>

                                    <div class="col-md-6 mb-2">
                                        <a href="shop&color=<?= strtoupper($m->nom) ?>" class="text-dark text-decoration-none text-kitea-hover">
                                            <span class="d-inline-block rounded-circle" style="width: 12px; height: 12px; background-color : <?= strtoupper($m->nom) ?>; border: solid #000 0.5px"></span>
                                            <span class="fw-bold"><?= strtoupper($m->nom) ?></span>
                                        </a>
                                    </div>
                                <?php endforeach ?>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

    <div class="col-lg-9 col-md-8">

        <div class="row">
            <?php foreach ($products as $key => $p) : ?>

                <?php
                $image = $pdo->query("SELECT nom FROM product_images WHERE product_id = $p->product_id and ranking = 1 LIMIT 1;")->fetch();
                $image = $image->nom ?? "1.jpg";


                ?>

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div class="card mb-3">
                        <a href="product_details&id=<?= $p->product_id ?>">
                            <img src="images/products/<?= $image  ?>" class="card-img-top" height="350" alt="Test Image">
                        </a>

                        <div class="card-body">

                            <h5><?= $p->product_nom ?></h5>
                            <div>
                                <span class="fw-bold me-2">$<?= _numbrer_format($p->prix) ?></span>
                                <small> <del class="text-danger">$<?= _numbrer_format($p->ancien_prix) ?></del></small>
                            </div>

                            <form method="post">
                                <input type="text" name="produit_id" value="<?= $p->product_id ?>">
                                <input type="text" name="prix" value="<?= $p->prix ?>">
                                <button name="add_to_cart" type="submit" class="btn btn-dark mt-3">Add to cart</button>
                            </form>
                        </div>

                    </div>

                </div>
                <!-- fin col -->
            <?php endforeach ?>

        </div>
        <!-- fin row -->

    </div>

</div>

<?php $content_html = ob_get_clean(); ?>