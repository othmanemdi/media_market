<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/logo/m.png" width="60" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Mobile</a></li>
                        <li><a class="dropdown-item" href="#">PC Bureaux</a></li>
                        <li><a class="dropdown-item" href="#">PC Portable</a></li>
                        <li><a class="dropdown-item" href="#">Accésoires</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page === 'home' ? 'text-info fw-bold' : '' ?>" aria-current="page" href="home">
                        Acceuil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?= $page === 'shop' ? 'text-info fw-bold' : '' ?>" aria-current="page" href="shop">
                        Boutique
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  <?= $page === 'contact' ? 'text-info fw-bold' : '' ?>" aria-current="page" href="contact">
                        Contactez-nous
                    </a>
                </li>

            </ul>
            <ul class="d-flex nav">
                <li class="nav-item">
                    <a href="login" class="nav-link link-dark px-2">Connection</a>
                </li>
                <li class="nav-item">
                    <a href="register" class="nav-link link-dark px-2 fw-bold">Créer un compte</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <img src="images/logo/media_market_logo.png" width="250" class="img-fluid rounded-top" alt="">
        </div>

        <div class="col-md-4">

            <div class="input-group input-group-lg mt-4">
                <input type="text" class="form-control border-info border-2 rounded-end rounded-pill " placeholder="Saisissez votre recherche...">
                <button class="btn btn-info text-white rounded-start rounded-pill px-4">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- 

<a href="cart" class="position-relative text-dark">
    <i class="fas fa-shopping-cart fs-5"></i>
    <span class="position-absolute top-75 start-100 translate-middle badge bg-kitea rounded-pill">
        3
    </span>
</a> -->