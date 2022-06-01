<?php

ob_start();
// php
$title = "Home";


$carousel_images_medium = glob('images/carousel/medium/*.jpg');

$content_php = ob_get_clean();


ob_start(); ?>

<div id="carouselExampleDark" class="carousel carousel-dark slide  " data-bs-ride="carousel">
    <div class="carousel-indicators" class="d-block w-100">
        <?php foreach ($carousel_images_medium as $key => $c) : ?>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?= $key ?>" class="<?= $key == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $key + 1 ?>"></button>
        <?php endforeach ?>

    </div>
    <div class="carousel-inner ">
        <?php foreach ($carousel_images_medium as $key => $c) : ?>
            <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>" data-bs-interval="2000">
                <img src="<?= $c ?>" class="d-block w-100" alt="...">
            </div>
        <?php endforeach ?>
    </div>


    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php $content_html = ob_get_clean(); ?>