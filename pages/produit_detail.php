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
    p.size,
    p.prix,
    p.ancien_prix,
    p.description,
    p.caractéristique,
   
    c.nom As categorie_nom,
    
    p.activated

    FROM products p

      
        LEFT JOIN categories c ON c.id = p.categorie_id
       
        WHERE p.id = $id
    LIMIT 1;")->fetch();



$image = $pdo->query("SELECT nom FROM product_images WHERE product_id = $id and ranking = 1  LIMIT 1;")->fetch()->nom;

$images = $pdo->query("SELECT id,nom FROM product_images WHERE product_id = $id ORDER BY ranking ASC;")->fetchAll();

$size = $product->size;

$product_colors = $pdo->query("SELECT
 pi.id,
 pi.nom 
FROM product_images pi
LEFT JOIN products p ON p.id = pi.product_id
WHERE p.size = '$size'
 AND pi.ranking = 1
 ")->fetchAll();








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
                <?= $product->size ?>
            </div>
            <div class="badge bg-success rounded-pill">
                Bio
            </div>




        </div>
        <div class="alert alert-info text-center">
            <?= $product->description ?>
        </div>



        <div>
            <del class="text-danger"><?= _numbrer_format($product->ancien_prix) ?> MAD</del>
            <h2 class="fw-bold"><?= _numbrer_format($product->prix) ?> MAD</h2>
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
            </form>
            <div>
            
            
            <a  href="wishlist" class="btn btn-warning fw-bold my-3"  data-added-text="Browse Wishlist">
            <i class="fa-solid fa-heart  text-light fs-5  bounce-bold"></i> 
            </a>
                 
            

            <a href="cart" class="btn btn-warning fw-bold my-3"><i class="fas fa-shopping-cart text-light fs-5  "></i></a>
       
            </div>




    </div>
</div>



<nav>
    <div class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0s" id="nav-tab" role="tablist">
        <a class="nav-link fs-4 px-2 link-dark" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-1" aria-selected="true">الوصف</a>
        <a class="nav-link fs-4 px-2 link-dark" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab" aria-controls="nav-3" aria-selected="false">رأي الزبائن</a>
        <a class="nav-link fs-4 px-2 link-dark" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button" role="tab" aria-controls="nav-4" aria-selected="false">فيديو</a>

    </div>
</nav>

<div class="tab-content my-3" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">


        <div class="alert alert-info text-center">
            <?= $product->caractéristique ?>
        </div>



    </div>

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