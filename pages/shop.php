<?php

ob_start();
// php
$title = "Shop";

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

  ORDER BY p.id DESC;")->fetchAll();


// $products = glob('images/products/*.jpg');

$couleurs = [];
$couleurs[] = "Gray";
$couleurs[] = "Brown";
$couleurs[] = "Black";
$couleurs[] = "Blue";
$couleurs[] = "Yellow";
$couleurs[] = "Red";
$couleurs[] = "Green";
$couleurs[] = "Pink";
$couleurs[] = "Purple";
$couleurs[] = "Orange";
$couleurs[] = "White";

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
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button p-0 px-4 py-1 bg-transparent text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="fw-bold h5 text-dark">CATÉGORIE</div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Salon
                                    <small> (156) </small>
                                </li>
                                <li class="list-group-item">
                                    Salle à manger
                                    <small> (156) </small>
                                </li>
                                <li class="list-group-item">
                                    Chambre à coucher
                                    <small> (156) </small>
                                </li>

                                <li class="list-group-item">
                                    Chambre enfant
                                    <small> (156) </small>
                                </li>

                                <li class="list-group-item">
                                    Chambre bébé
                                    <small> (156) </small>
                                </li>

                                <li class="list-group-item">
                                    Rangement
                                    <small> (156) </small>
                                </li>

                                <li class="list-group-item">
                                    Mobilier pro
                                    <small> (156) </small>
                                </li>

                                <li class="list-group-item">
                                    Jardin
                                    <small> (156) </small>
                                </li>
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
                                <?php foreach ($couleurs as $key => $c) : ?>

                                    <div class="col-md-6 mb-2">
                                        <a href="shop&color=<?= $c ?>" class="text-dark text-decoration-none text-kitea-hover">
                                            <span class="d-inline-block rounded-circle" style="width: 12px; height: 12px; background-color :<?= $c ?>; border: solid #000 0.5px"></span>
                                            <span class="fw-bold"><?= $c ?></span>
                                        </a>
                                    </div>
                                <?php endforeach ?>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="accordion-item mb-3 border-0 ronded">
                    <h2 class="accordion-header" id="heading_3">
                        <button class="accordion-button collapsed p-0 px-4 py-1 bg-transparent text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_3" aria-expanded="false" aria-controls="collapse_3">
                            <div class="fw-bold h5 text-dark">Price</div>
                        </button>
                    </h2>
                    <div id="collapse_3" class="accordion-collapse collapse show" aria-labelledby="heading_3">
                        <div class=" accordion-body">

                            <input type="range" class="form-range" min="0" max="5" id="customRange2">
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" value="0" name="" id="">
                                </div>

                                <div class="col">
                                    <input type="number" class="form-control" value="60" name="" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="my-3">Catégories</h5>
            <ul class="list-group list-group-flush">

                <li class="list-group-item">
                    Salon</a>
                    <small> (156) </small>
                </li>
                <li class="list-group-item">
                    Salle à manger</a>
                    <small> (156) </small>
                </li>
                <li class="list-group-item">
                    Chambre à coucher</a>
                    <small> (156) </small>
                </li>

                <li class="list-group-item">
                    Chambre enfant</a>
                    <small> (156) </small>
                </li>

                <li class="list-group-item">
                    Chambre bébé</a>
                    <small> (156) </small>
                </li>

                <li class="list-group-item">
                    Rangement</a>
                    <small> (156) </small>
                </li>

                <li class="list-group-item">
                    Mobilier pro</a>
                    <small> (156) </small>
                </li>

                <li class="list-group-item">
                    Jardin</a>
                    <small> (156) </small>
                </li>
            </ul>

            <h5 class="my-3">Couleurs</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Rouge </li>
                <li class="list-group-item">Jaune </li>
                <li class="list-group-item">Noir </li>
                <li class="list-group-item">Blanc </li>
            </ul>

        </div>
    </div>

    <div class="col-lg-9 col-md-8">

        <div class="row">
            <?php foreach ($products as $key => $p) : ?>

                <?php
                $image = $pdo->query("SELECT nom FROM product_images WHERE product_id = $p->product_id and ranking = 1  LIMIT 1;")->fetch()->nom;


                ?>

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div class="card mb-3">
                        <a href="product_details&id=<?= $p->product_id ?>">
                            <img src="images/products/<?= $image ?>" class="card-img-top" height="350" alt="Test Image">
                        </a>

                        <div class="card-body">

                            <h5><?= $p->product_nom ?></h5>
                            <div>
                                <span class="fw-bold me-2">$<?= _numbrer_format($p->prix) ?></span>
                                <small> <del class="text-danger">$<?= _numbrer_format($p->ancien_prix) ?></del></small>
                            </div>
                            <a href="cart" class="btn btn-dark mt-3">Add to cart</a>

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