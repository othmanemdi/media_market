<?php

ob_start();
// php
$title = "Product details";



if (!isset($_GET['id'])) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: shop');
    die();
}

$id = (int)$_GET['id'];

if ($id == 0) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: shop');
    die();
}




$product = $pdo->query("SELECT 
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
        WHERE p.id = $id
    LIMIT 1;")->fetch();



$image = $pdo->query("SELECT nom FROM product_images WHERE product_id = $id and ranking = 1  LIMIT 1;")->fetch()->nom;

$images = $pdo->query("SELECT id,nom FROM product_images WHERE product_id = $id ORDER BY ranking ASC;")->fetchAll();

$reference = $product->reference;

$product_colors = $pdo->query("SELECT
 pi.id,
 pi.nom 
FROM product_images pi
LEFT JOIN products p ON p.id = pi.product_id
WHERE p.reference = '$reference'
 AND pi.ranking = 1
 ")->fetchAll();



$caracteristiques = [];
$caracteristiques[0]['name'] = "Processeur";
$caracteristiques[0]['value'] = "Apple M1 8-core (Neural Engine 16 cœurs)";

$caracteristiques[1]['name'] = "Carte graphique";
$caracteristiques[1]['value'] = "Apple M1 8-core";

$caracteristiques[2]['name'] = "Disque dur";
$caracteristiques[2]['value'] = "512Go SSD";

$caracteristiques[3]['name'] = "RAM installée";
$caracteristiques[3]['value'] = "8Go";

$caracteristiques[4]['name'] = "Mémoire maximale installable";
$caracteristiques[4]['value'] = "16Go";

$caracteristiques[5]['name'] = "Taille de l'écran (pouces)";
$caracteristiques[5]['value'] = "24";

$caracteristiques[6]['name'] = "TRésolution maximale de la carte graphique";
$caracteristiques[6]['value'] = "4480 x 2520 Pixels (4.5K)";

// $caracteristiques[7]['name'] = "Caractéristiques de l'écran";
// $caracteristiques[7]['value'] = "Résolution à 218 pixels par pouce, avec prise en charge d’un milliard de couleurs; Luminosité de 500 nits; Large gamme de couleurs (P3); Technologie True Tone";

$caracteristiques_2 = [];
$caracteristiques_2[0]['name'] = "Communications sans fil";
$caracteristiques_2[0]['value'] = "Bluetooth 5.0  <br>
Wifi 802.11 ax Compatible avec la norme IEEE 802.11a/b/g/n/ac";

$caracteristiques_2[1]['name'] = "Connectique";
$caracteristiques_2[1]['value'] = "2 USB 4.0 avec prise en charge de : DisplayPort; Thunderbolt 3 (jusqu’à 40 Gbit/s); USB 4 (jusqu’à 40 Gbit/s); USB 3.1 Gen 2 (jusqu’à 10 Gbit/s); Sorties Thunderbolt 2, HDMI, DVI et VGA prises en charge à l’aide d’adaptateurs (vendus séparément)
2 USB 3.0";

$caracteristiques_2[2]['name'] = "Nombre de haut-parleurs intégrés";
$caracteristiques_2[2]['value'] = "6 Haute fidélité avec woofers à annulation de force";

$caracteristiques_2[3]['name'] = "Autres fonctions";
$caracteristiques_2[3]['value'] = "Microphone intégré <br>
Webcam intégrée  <br>
Lecteur d'empreintes digitales";

$caracteristiques_2[4]['name'] = "Dimensions";
$caracteristiques_2[4]['value'] = "54.7 x 46.1 x 14.7 mm";

$caracteristiques_2[5]['name'] = "Poids";
$caracteristiques_2[5]['value'] = "4.48 Kg";

$caracteristiques_2[6]['name'] = "Caractéristiques complémentaires";



$caracteristiques_2[6]['value'] = "CPU 8 cœurs avec 4 cœurs de performance et 4 cœurs à haute efficacité énergétique; Configurable avec 1 ou 2 To; Caméra FaceTime HD 1080p avec le processeur de signal d’image de la puce M1; Prise en charge simultanée de la résolution native sur l’écran intégré d’un milliard de couleurs et de : Un écran externe d’une résolution atteignant 6K à 60 Hz; Sortie vidéo numérique Thunderbolt 3; Sortie DisplayPort native par USB‑C; Sorties VGA, HDMI, DVI et Thunderbolt 2 prises en charge à l’aide d’adaptateurs (vendus séparément); Son stéréo ample; Prise en charge de l’audio spatial lors de la lecture de vidéo avec Dolby Atmos; Icône Ensemble de trois micros de qualité studio; Ensemble de trois micros de qualité studio avec rapport signal sur bruit élevé et beamforming directionnel; Icône Prise en charge de « Dis Siri »Prise en charge de « Dis Siri »; Tension : de 100 à 240 V CA; Fréquence : de 50 à 60 Hz, monophasé; Température d’utilisation : de 10 à 35 °C; Humidité relative : de 5 à 90 % sans condensation; Altitude maximale : testé jusqu’à 5 000 mètres; Fonctionnalités incluses : Contrôle vocale, VoiceOver, Zoom, Augmenter le contraste, Réduire les animations, Siri et Dictée, Contrôle de sélection, Sous‑titres codés, Synthèse vocale";

$content_php = ob_get_clean();


ob_start(); ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item"><a href="#">Boutique</a></li>
        <li class="breadcrumb-item"><a href="#">Ordinateurs</a></li>
        <li class="breadcrumb-item"><a href="#">Pc Bureau</a></li>
        <li class="breadcrumb-item active" aria-current="page">IMac Apple iMac 24" Puce M1</li>
    </ol>
</nav>


<div class="row">
    <div class="col-md-7">

        <div class="d-flex mb-3 sticky-top">
            <div class="p-2">
                <img id="expandedImg" width="600" src="images/products/<?= $image ?>" alt="" class="img-fluid border border-light border-3 rounded">
            </div>
            <div class="me-auto p-2">

                <div id="thumbnail" class="d-flex align-items-end flex-column mb-3" style="height: 200px;">
                    <?php foreach ($images as $key => $m) : ?>
                        <img onclick="myFunction(this);" class="img-thumbnail pointer mb-2 border-light border-3 rounded <?= $key === 0 ? 'shadow border-darka' : '' ?> " width="80" src="images/products/<?= $m->nom ?>">
                    <?php endforeach ?>

                </div>

            </div>
        </div>
    </div>
    <div class="col-md-5">

        <h2><?= $product->product_nom ?></h2>
        <div class="d-flex">
            <div class="me-auto">
                Référence: <?= $product->reference ?>
            </div>
            <div class="badge bg-info rounded-pill">
                Produit Neuf
            </div>
        </div>

        <div>
            <del class="text-danger"><?= _numbrer_format($product->prix) ?> MAD</del>
            <h2 class="fw-bold"><?= _numbrer_format($product->ancien_prix) ?> MAD</h2>
        </div>

        <div class="bd-callout bd-callout-success">
            <span class="fw-bold text-success fs-6">
                <i class="fas fa-certificate"></i> Garantie 1 an
            </span>
            Pièces et main d'oeuvre

        </div>

        <form>
            <div class="from-group">
                <label for="Qt" class="fw-bold">Quantité:</label>
                <input type="number" class="form-control w-25" value="1">
            </div>

            <button class="btn btn-dark fw-bold my-3">AJOUTER AU PANIER</button>
        </form>

        <div class="carda">
            <div class="card-body">
                <div class="my-3">
                    Couleur: <i style="color: <?= $product->couleur_nom ?>" class="fas fa-circle"></i> <?= $product->couleur_nom ?>
                </div>
                <div class="row">

                    <?php foreach ($product_colors as $key => $m) : ?>
                        <div class="col-md-2">
                            <img onclick="myFunction(this);" class="img-thumbnail pointer mb-2 border-light border-3 rounded <?= $key === 0 ? 'shadowa border-darka' : '' ?> " width="80" src="images/products/<?= $m->nom ?>">
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>

        <div class="alert alert-info text-center">
            <div>
                à partir de 999,58 dhs/mois*
            </div>

            <button class="btn btn-dark fw-bold rounded-pill my-3">
                PAR ICI CRÉDIT GRATUIT 0%
            </button>

            <div>
                * Pendant 24 mois, sous reserve d'acceptation de votre dossier par l'organisme de financement partenaire. - Voir conditions
            </div>
        </div>

    </div>
</div>



<nav>
    <div class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0s" id="nav-tab" role="tablist">
        <a class="nav-link fs-4 px-2 link-dark" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-1" aria-selected="true">DESCRIPTION</a>


        <a class="nav-link fs-4 px-2 link-dark" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-2" aria-selected="false">CARACTÉRISTIQUES</a>


        <a class="nav-link fs-4 px-2 link-dark" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab" aria-controls="nav-3" aria-selected="false">AVIS CLIENTS</a>


        <a class="nav-link fs-4 px-2 link-dark" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button" role="tab" aria-controls="nav-4" aria-selected="false">VIDEOS</a>



    </div>
</nav>

<div class="tab-content my-3" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
        <img src="images/products/mac/descriptions/F19BCA0F-6519-127A-DD09-2C1DC4A05BE4.jpg" alt="" class="img-fluid">

        <img src="images/products/mac/descriptions/69450E65-DB8A-EDD6-79EE-F6BABBF1B991.jpg" alt="" class="img-fluid">


        <img src="images/products/mac/descriptions/96ECC712-B94B-16F3-63D7-757CC2A3A5F2.jpg" alt="" class="img-fluid">

        <img src="images/products/mac/descriptions/8AAC379E-86A5-BBF4-AA45-58C4792E42EA.jpg" alt="" class="img-fluid">


        <img src="images/products/mac/descriptions/D1504CE7-EAEA-7AB9-4937-B13AD1505680.jpg" alt="" class="img-fluid">

        <img src="images/products/mac/descriptions/01BC250F-163A-2106-5752-AE72842050E4.jpg" alt="" class="img-fluid">

        <img src="images/products/mac/descriptions/2247F93C-B876-FEC6-BFE8-F41EAA96B5AF.jpg" alt="" class="img-fluid">


    </div>
    <div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">

        <div class="row">
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <?php foreach ($caracteristiques as $key => $c) : ?>

                        <li class="list-group-item py-3 d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"><?= $c['name'] ?></div>
                            </div>
                            <div class="text-muted"><?= $c['value'] ?></div>
                        </li>


                    <?php endforeach ?>
                </ul>
            </div>

            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <?php foreach ($caracteristiques_2 as $key => $c) : ?>

                        <li class="list-group-item">
                            <div class="ms-2">
                                <div class="fw-bold fs-5 mb-3 ">
                                    <?= $c['name'] ?>
                                </div>
                                <div class="text-muted">
                                    <?= $c['value'] ?>
                                </div>

                            </div>

                        </li>
                    <?php endforeach ?>

                </ul>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">3</div>
    <div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">4</div>
</div>


<?php $content_html = ob_get_clean();

ob_start(); ?>


<script>
    // Get the container element
    var thumbnails = document.getElementById("thumbnail");
    // let thumbnails = document.querySelectorAll('#thumbnail img');

    // Get all buttons with class="btn" inside the container
    var img_thumbnail = thumbnails.getElementsByClassName("img-thumbnail");

    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < img_thumbnail.length; i++) {
        console.log(img_thumbnail[i])

        img_thumbnail[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("shadow");
            // var current = document.getElementsByClassName("border-dark");

            // If there's no active class
            if (current.length > 0) {
                current[0].className = current[0].className.replace(" shadow", "");
                // current[0].className = current[0].className.replace(" border-dark", "");
            }

            // Add the active class to the current/clicked button
            this.className += " shadow";
            // this.className += " border-dark";
        });
    }

    function myFunction(imgs) {
        // Get the expanded image
        var expandImg = document.getElementById("expandedImg");
        // Use the same src in the expanded image as the image being clicked on from the grid
        expandImg.src = imgs.src;
        // Show the container element (hidden with CSS)
        expandImg.parentElement.style.display = "block";

        // event.target.classList.add('shadow');






    }

    // document.addEventListener('click', function myFunction(imgs) {

    //     // Get the expanded image
    //     var expandImg = document.getElementById("expandedImg");
    //     // Use the same src in the expanded image as the image being clicked on from the grid
    //     expandImg.src = imgs.src;
    //     // Show the container element (hidden with CSS)
    //     expandImg.parentElement.style.display = "block";
    //     // expandImg.classList.add('shadow');
    //     event.target.classList.add('shadow', 'border-dark');

    // });
</script>

<?php $content_js = ob_get_clean(); ?>