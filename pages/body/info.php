<?php

$ip_server = IP_SERVER;

$cart_count = $pdo->prepare("SELECT SUM(pp.qt) As qt_panier FROM paniers p 
    LEFT JOIN panier_produits pp ON pp.panier_id = p.id
    WHERE p.ip = :ip LIMIT 1 ");

$cart_count->execute(['ip' => $ip_server]);

$qt_panier = $cart_count->fetch()->qt_panier ?? 0;
?>




<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">

   
        <div class="container-fluid">
            <li class="list-inline-item text-yahya-hover ">
                <a class="nav-link link-primary text-centre px-2 fa-solid fa-envelope fa-bounce text-light fs-5" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; --fa-bounce-rebound: 0; fs-5   fw-bold' : " href="https://info@yahyaabidou.ma "></a>

            </li>

            <li class="list-inline-item text-yahya-hover ">
                <a class="nav-link link-primarytext-centre px-2 fa-brands fa-whatsapp fa-bounce text-light fs-5 ' bounce-bold' : " href="https://wa.me/qr/6Q43NFZRNMN7P1"></a>
            </li>
            <li class="list-inline-item text-yahya-hover ">
                <a class="nav-link link-primary text-centre px-2 fab fa-youtube fa-bounce text-light fs-5 ' bounce-bold' : " href="https://youtube.com/c/YahyaAbidou"></a>
            </li>
            <li class="list-inline-item text-yahya-hover ">
                <a class="nav-link link-primary text-centre px-2 fab fa-instagram fa-bounce text-light fs-5 ' bounce-bold' : " href="https://www.instagram.com/yahya_abidou/"></a>
            </li>
            <li class="list-inline-item text-yahya-hover ">
                <a class="nav-link link-primary text-centre px-2 fab fa-facebook-f fa-bounce text-light fs-5 ' bounce-bold' : " href="https://facebook.com/100531979420755"></a>
            </li>
      

        </div>
        
        <div  class="input-group input-group-lg" >
                    <button class="btn bg-warning text-white rounded-start rounded-pill px-4">
                        <i class="fas fa-search fa-spin "></i>
                    </button> 
                    <input type="text"   class="form-control border-warning border-2 rounded-end rounded-pill " placeholder="Saisissez votre recherche...">
                </div>
              
              
            <li class="list-inline-item text-yahya-hover ">
                <a href="cart" class="nav-link link-primarytext-centre px-2">
                <span class="position-absolute top-70  translate-middle badge bg-info rounded-pill">
                        <?= $qt_panier ?></span>
                    <i class="fas fa-shopping-cart text-light fs-5  "></i>
                </a>

            </li>


            <li class="list-inline-item text-yahya-hover ">
                <a href="register" class="nav-link link-primarytext-centre px-2">
                    <i class="fa-solid fa-user-plus  text-light fs-5 bounce-bold "></i>

                </a>
            </li>

            <li class="list-inline-item text-yahya-hover ">
                <a href="login" class="nav-link link-primarytext-centre px-2">
                    <i class="fa-solid fa-user  text-light fs-5 bounce-bold "></i>

                </a>
            </li>

            <li class="list-inline-item text-yahya-hover ">

                <a href="wishlist" class="nav-link link-primarytext-centre px-2">
                <span class="position-absolute top-70 start-150 translate-middle badge bg-info rounded-pill">
                        0
                    </span>
                    <i class="fa-solid fa-heart  text-light fs-5  bounce-bold"></i>
                   
                </a>
            </li>
        </div>
    
    </div>
    </div>
    </div>
    </div>
</nav>



























</div>



</div>
</div>