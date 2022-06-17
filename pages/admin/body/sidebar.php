<div class="list-group sticky-topa">
    <a href="home" class="list-group-item list-group-item-action <?= $page == "home" ? "activated" : "" ?>" aria-current="true">
        Dashboard
    </a>

    <a href="clients" class="list-group-item list-group-item-action <?= $page == "clients" ? "activated" : "" ?>">
        Clients
    </a>

    <a href="commandes" class="list-group-item list-group-item-action <?= in_array($page, ["commandes", "commande_details"]) ? "activated" : "" ?>">
        Commandes
    </a>

    <a href="status" class="list-group-item list-group-item-action <?= $page == "status" ? "activated" : "" ?>">
        Status des commandes
    </a>

    <a href="fournisseurs" class="list-group-item list-group-item-action <?= $page == "fournisseurs" ? "activated" : "" ?>">
        Fournisseurs
    </a>

    <a href="stock" class="list-group-item list-group-item-action <?= $page == "stock" ? "activated" : "" ?>">
        Stock
    </a>

    <a href="entrees" class="list-group-item list-group-item-action <?= $page == "entrees" ? "activated" : "" ?>">
        Entrées
    </a>

    <a href="sorties" class="list-group-item list-group-item-action <?= $page == "sorties" ? "activated" : "" ?>">
        Sorties
    </a>

    <a href="produits" class="list-group-item list-group-item-action <?= $page == "produits" ? "activated" : "" ?>">
        Produits
    </a>

    <a href="marques" class="list-group-item list-group-item-action <?= in_array($page, ["marques", "marque_add", "marque_update"]) ? "activated" : "" ?>">
        Marques
    </a>

    <a href="categories" class="list-group-item list-group-item-action <?= in_array($page, ["categories", "categorie_add"]) ? "activated" : "" ?>">
        Catégories
    </a>


    <a href="couleurs" class="list-group-item list-group-item-action <?= in_array($page, ["couleurs", "couleur_add"]) ? "activated" : "" ?>">
        Couleurs
    </a>

    <a href="coupons" class="list-group-item list-group-item-action <?= in_array($page, ["coupons", "coupon_add"]) ? "activated" : "" ?>">
        Coupons code
    </a>

    <a href="roles" class="list-group-item list-group-item-action <?= $page == "roles" ? "activated" : "" ?>">
        Roles
    </a>


    <a href="profile" class="list-group-item list-group-item-action <?= $page == "profile" ? "activated" : "" ?>">
        Profile
    </a>

    <a class="list-group-item list-group-item-action text-danger fw-bold">
        Se déconnecter
    </a>
</div>