<?php

$ip_server = IP_SERVER;

$cart_count = $pdo->prepare("SELECT SUM(pp.qt) As qt_panier FROM paniers p 
    LEFT JOIN panier_produits pp ON pp.panier_id = p.id
    WHERE p.ip = :ip LIMIT 1 ");

$cart_count->execute(['ip' => $ip_server]);

$qt_panier = $cart_count->fetch()->qt_panier ?? 0;
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-auto me-auto mb-3">
            <img src="images/logo/media_market_logo.png" alt="" height="70" class="mt-0">
        </div>

        <div class="col-md-5 me-auto mb-3">

            <div class="input-group input-group-lg">
                <input type="text" class="form-control border-dark border-2 rounded-end rounded-pill " placeholder="Saisissez votre recherche...">
                <button class="btn bg-dark text-white rounded-start rounded-pill px-4">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <!-- 
        <div class="col-auto mb-4">
            <div class="ms-4 mt-3">
                <a href="cart" class="position-relative text-dark">
                    <i class="fa-solid fa-user"></i>
                    <span class="position-absolute top-75 start- translate-middle badge bg-info rounded-pill">
                        0
                    </span>
                </a>
            </div>
        </div>


        <div class="col-auto mb-4">
            <div class="ms-4 mt-3">
                <a href="cart" class="position-relative text-dark">
                    <i class="fa-solid fa-heart"></i>
                    <span class="position-absolute top-75 start- translate-middle badge bg-info rounded-pill">
                        0
                    </span>
                </a>
            </div>
        </div> -->


        <div class="col-auto mb-3">
            <div class="ms-4 mt-3">
                <a href="cart" class="position-relative text-dark">
                    <i class="fas fa-shopping-cart fs-5"></i>
                    <span class="position-absolute top-75 start-150 translate-middle badge bg-info rounded-pill">
                        <?= $qt_panier ?>
                    </span>
                </a>
            </div>
        </div>

    </div>
</div>