<?php

ob_start();
// php
$title = "Liste of product";

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

// dd($products);
$content_php = ob_get_clean();


ob_start(); ?>

<h3>Liste of product</h3>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm table-stripeda text-nowrapa">
        <thead>
            <tr>
                <th>Id</th>
                <th>Img</th>
                <th>Référence</th>
                <th>Nom</th>
                <th>Marque</th>
                <th>Couleur</th>
                <th>Activated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($products as $key => $p) : ?>

                <?php
                $image = $pdo->query("SELECT nom FROM product_images WHERE product_id = $p->product_id and ranking = 1  LIMIT 1;")->fetch()->nom;

                $images = $pdo->query("SELECT id,nom FROM product_images WHERE product_id = $p->product_id ORDER BY ranking ASC;")->fetchAll();

                ?>
                <tr>
                    <th>
                        <?= $p->product_id ?>
                    </th>
                    <td>
                        <img src="../images/products/<?= $image ?>" width="20" alt="">
                    </td>
                    <td>
                        <?= strtoupper($p->reference) ?>
                    </td>
                    <td>
                        <?= strtoupper($p->product_nom) ?>
                    </td>


                    <td>
                        <?= strtoupper($p->marque_nom) ?>
                    </td>


                    <td>
                        <?= strtoupper($p->couleur_nom) ?>
                    </td>
                    <td>
                        <span class=" text-<?= $p->activated ? "success" : "danger" ?>">
                            <i class="fas fa-<?= $p->activated ? "check-circle" : "times-circle" ?>"></i>
                        </span>
                    </td>
                    <td>

                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#product_info_<?= $p->product_id ?>">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="product_info_<?= $p->product_id ?>" tabindex="-1" aria-labelledby="product_info_<?= $p->product_id ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="product_info_<?= $p->product_id ?>Label">
                                            <?= strtoupper($p->product_nom) ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                        <div class="row">
                                            <div class="col-md-5">



                                                <div id="carousel_<?= $p->product_id ?>" class="carousel slide" data-bs-ride="true">
                                                    <div class="carousel-indicators">


                                                        <?php foreach ($images as $k => $img) : ?>
                                                            <?php if ($k == 0) : ?>
                                                                <button type="button" data-bs-target="#carousel_<?= $p->product_id ?>" data-bs-slide-to="<?= $k ?>" class="active" aria-current="true" aria-label="Slide <?= $k + 1 ?>"></button>
                                                            <?php else : ?>
                                                                <button type="button" data-bs-target="#carousel_<?= $p->product_id ?>" data-bs-slide-to="<?= $k ?>" aria-label="Slide <?= $k + 1 ?>"></button>
                                                            <?php endif ?>

                                                        <?php endforeach  ?>
                                                    </div>
                                                    <div class="carousel-inner">
                                                        <?php foreach ($images as $k2 => $img) : ?>
                                                            <div class="carousel-item <?= $k2 == 0 ? 'active' : '' ?>" data-bs-interval="500">
                                                                <img src="../images/products/<?= $img->nom ?>" class="d-block w-100" alt="...">
                                                            </div>
                                                        <?php endforeach  ?>

                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_<?= $p->product_id ?>" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel_<?= $p->product_id ?>" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>









                                            </div>

                                            <div class="col-md-7">

                                                <dl class="row">
                                                    <dt class="col-sm-3">
                                                        Référence:
                                                    </dt>
                                                    <dd class="col-sm-9">
                                                        <?= strtoupper($p->reference) ?>
                                                    </dd>

                                                    <dt class="col-sm-3">
                                                        Nom:
                                                    </dt>
                                                    <dd class="col-sm-9">
                                                        <?= strtoupper($p->product_nom) ?>
                                                    </dd>


                                                    <dt class="col-sm-3">
                                                        Prix:
                                                    </dt>
                                                    <dd class="col-sm-9">

                                                        <?= _numbrer_format($p->prix) ?> DH <del class="text-danger">
                                                            <?= _numbrer_format($p->ancien_prix) ?> DH
                                                        </del>

                                                    </dd>




                                                    <dt class="col-sm-3">
                                                        Marque:
                                                    </dt>
                                                    <dd class="col-sm-9">
                                                        <?= strtoupper($p->marque_nom) ?>
                                                    </dd>



                                                    <dt class="col-sm-3">
                                                        Catégorie:
                                                    </dt>
                                                    <dd class="col-sm-9">
                                                        <?= strtoupper($p->categorie_nom) ?>
                                                    </dd>


                                                    <dt class="col-sm-3">
                                                        Couleur:
                                                    </dt>
                                                    <dd class="col-sm-9">
                                                        <?= strtoupper($p->couleur_nom) ?>
                                                    </dd>

                                                </dl>

                                            </div>
                                        </div>






                                    </div>

                                </div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-dark">
                            <i class="fa-solid fa-wrench"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach  ?>

        </tbody>
    </table>
</div>


<?php $content_html = ob_get_clean(); ?>