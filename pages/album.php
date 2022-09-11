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
    WHERE p.activated = 1
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
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">الرئيسية</a></li>

        <li class="breadcrumb-item active" aria-current="page">ألبوم الصور</li>
    </ul>
</nav>

<div class="row">
    <div class="col-lg-3 col-md-4">
        <div class="sticky-sm-top">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item mb-0 border-0 ronded mb-3">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button p-0 px-4 py-1 bg-transparent text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="fw-bold h5 text-dark">ألبوم الصور</div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                   رحلة ماليزيا
                                    
                                </li>
                                <li class="list-group-item">
                                   رحلة الصين
                                </li>
                                <li class="list-group-item">
                                 رحلة تركيا
                                </li>

                               

                                <li class="list-group-item">
                                     مؤتمرات عالمية
                                </li>

                                <li class="list-group-item">
                                   محاضرات لفريق النجاح
                                </li>

                              
                            </ul>

                        </div>
                    </div>
                </div>


               


                <div class="accordion-item mb-3 border-0 ronded">
                    <h2 class="accordion-header" id="heading_3">
                        
                    </h2>
                    <div id="collapse_3" class="accordion-collapse collapse show" aria-labelledby="heading_3">
                        
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

                        

                    </div>

                </div>
                <!-- fin col -->
            <?php endforeach ?>

        </div>
        <!-- fin row -->

    </div>

</div>

<?php $content_html = ob_get_clean(); ?>