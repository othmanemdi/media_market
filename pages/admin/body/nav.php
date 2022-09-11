<nav class="bg-yahya  border-bottom border-warning  sticky-top  ">
  <div class=" container  ">
    <div class="d-flex flex-wrap">
      

          <img src="images\logo\1x\1x\SVG\Artboard 1.svg" alt="" height="80">
        </div>


          <ul class="nav justify-content-end ">
            <li class="nav-item">
              <a class="nav-link link-warning px-2 <?= $page == "profil" ? 'text-danger fw-bold' : "" ?>" href="profil">الصفحة الشخصية</a>
            </li>

       
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php  ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page == "commandes" ? "active" : "" ?>" aria-current="page" href="commandes">Commande</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link <?= $page == "stock" ? "active" : "" ?>" aria-current="page" href="stock">Stock</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == "produits" ? "active" : "" ?>" aria-current="page" href="produits">Produits</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == "clients" ? "active" : "" ?>" aria-current="page" href="clients">Clients</a>
                </li>
            <?php ?>

            </ul>

            <ul class="navbar-nav d-flex">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        يحيى اعبيدو
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item <?= $page == "profil" ? "active" : "" ?>" href="profil">صفحة شخصية</a></li>
                        <li><a class="dropdown-item" href="#"> خروج</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>







