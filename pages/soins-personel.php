<?php

 ob_start();
 //php
 $title = "soins-personel";

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
  p.size,
  p.prix,
  p.ancien_prix,

  c.nom As categorie_nom,
 
  p.activated

  FROM products p


      LEFT JOIN categories c ON c.id = p.categorie_id
  
  WHERE p.categorie_id= 1
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




$categories = $pdo->query("SELECT * FROM categories")->fetchAll();






 $content_php = ob_get_clean();


 ob_start(); ?>

            <div class="texte-center p-5 mt-3">

            <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">الرئيسية</a></li>
        <li class="breadcrumb-item active" aria-current="store_dxn">منتجات dxn </li>
        <li class="breadcrumb-item active" aria-current="page">العناية الشخصية </li>
    </ul>
</nav>

<div class=" p-5 mt-3">

<div class="row g-0  mt-3">
<div class="col-sm-6 col-md-2"></div>

  <div class="col-sm-6 col-md-8">
  
  
    <div class=" texte-warning mb-5" style="text-align: center;">

  
منتوجات Dxn

هدايا الطبيعة المذهلة للإنسان من DXN

( منتجات صحية عضوية طبيعية ، استهلاكية ، متنوعة ، ذات جودة عالية ،

نادرة ، وعالمية )
<br>

 DXN هي منتجات استثنائية أختيرت عبر الزمن والنتائج
<br>

تنقسم للأصناف التالية : الأغذية والمشروبات الصحية ، المكملات الغذائية ،

منتجات العناية الشخصية ومنتجات التجميل
.
</div>

</div>
</div>



<div class="row">
    <div class="col-lg-3 col-md-4">
        <div class="sticky-sm-top">

            <div class="accordion" id="accordionExample">
                

                <div class="accordion-item mb-0 border-0 ronded mb-3">
                    
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
                        <a href="produit_detail&id=<?= $p->product_id ?>">
                            <img src="images/products/<?= $image  ?>" class="card-img-top" height="350" alt="Test Image">
                        </a>

                        <div class="card-body">

                            <h5><?= $p->product_nom ?></h5>
                            <div>
                                <span class="fw-bold me-2">$<?= _numbrer_format($p->prix) ?></span>
                                <small> <del class="text-danger">$<?= _numbrer_format($p->ancien_prix) ?></del></small>
                            </div>

                            <form method="post">
                            <a  href="wishlist" class="btn btn-warning fw-bold my-3"  data-added-text="Browse Wishlist">
            <i class="fa-solid fa-heart  text-light fs-5  bounce-bold"></i> 
            </a>
            
                            <a href="cart" class="btn btn-warning fw-bold my-3"><i class="fas fa-shopping-cart text-light fs-5  "></i></a>
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


