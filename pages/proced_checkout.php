<?php

ob_start();
// php
$title = "Proced to checkout";
$ip_server = IP_SERVER;

$prix_panier = $pdo->prepare("SELECT SUM(pp.prix) AS prix_panier FROM paniers p 
    LEFT JOIN panier_produits pp ON pp.panier_id = p.id
    WHERE p.ip = :ip LIMIT 1 ");

$prix_panier->execute(['ip' => $ip_server]);

$prix_panier = $prix_panier->fetch();


if (!$prix_panier) {
    $_SESSION['flash']['danger'] = 'Panier vide';
    header('Location: shop');
    exit();
}

$order_summary = $prix_panier->prix_panier ?? 0;

// Récupérer les infos de panier
$panier_info = $pdo->prepare("SELECT id FROM paniers WHERE ip = :ip LIMIT 1 ");

$panier_info->execute(['ip' => $ip_server]);

$panier_id = $panier_info->fetch()->id;

if (isset($_POST['proced_to_checkout'])) {

    // dd($_POST);
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $ville = $_POST['ville'];

    $req = $pdo->prepare("INSERT INTO users SET prenom = ?, nom = ?, adresse = ?, email = ?, telephone = ?, ville = ? , role_id = ?");
    $req->execute([$prenom, $nom, $adresse, $email, $telephone, $ville, 3]);
    $user_id = $pdo->lastInsertId();


    $panier = $pdo->prepare("UPDATE paniers SET user_id = :user_id WHERE ip = :ip");
    $panier->execute(
        ['user_id' => $user_id, 'ip' => $ip_server]
    );


    // Créér la commande

    $panier = $pdo->prepare("INSERT INTO commandes SET user_id = :user_id");
    $panier->execute(
        ['user_id' => $user_id]
    );
    $commande_id = $pdo->lastInsertId();



    // Créer les produits de la commande à partir de panier




    $prix_panier = $pdo->prepare("SELECT SUM(pp.prix) AS prix_panier FROM paniers p 
LEFT JOIN panier_produits pp ON pp.panier_id = p.id
WHERE p.ip = :ip LIMIT 1 ");




    $paniers = $pdo->prepare("SELECT 
            pp.produit_id,
            pp.qt, 
            pp.prix
        FROM panier_produits pp
        LEFT JOIN paniers p ON p.id = pp.panier_id
         WHERE p.user_id = :user_id");
    $paniers->execute(
        [
            'user_id' => $user_id
        ]
    );
    // dd($paniers->fetchAll());
    $paniers = $paniers->fetchAll();
    foreach ($paniers as $key => $panier) {
        $panier_add = $pdo->prepare("INSERT INTO commande_produits SET 
        commande_id = :commande_id,
        produit_id  = :produit_id,
        qt = :qt,
        prix = :prix");
        $panier_add->execute(
            [
                'commande_id' => $commande_id,
                'produit_id' => $panier->produit_id,
                'qt' => $panier->qt,
                'prix' => $panier->prix
            ]
        );
    }
    //Vider le panier
    $pdo->query("DELETE FROM panier_produits WHERE panier_id = $panier_id");
    $pdo->query("DELETE FROM paniers WHERE user_id = $user_id");

    $_SESSION['flash']['success'] = 'Votre commande a été créé';
    header('Location: thanx_page');
    exit();
}

$content_php = ob_get_clean();


ob_start(); ?>

<h3>Proced to checkout</h3>
<form method="post">
    <div class="row">
        <div class="col-md-8">
            <h3>Invoice Adresse</h3>

            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>
                                    First Name: <span class="text-danger fw-bold">*</span>
                                </label>
                                <input type="text" name="prenom" class="form-control" placeholder="First Name:">
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="form-group mb-3">
                                <label>
                                    Last Name: <span class="text-danger fw-bold">*</span>
                                </label>
                                <input type="text" name="nom" class="form-control" placeholder="Last Name:">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>
                                    Address: <span class="text-danger fw-bold">*</span>
                                </label>
                                <input name="adresse" type="text" class="form-control" placeholder="Address:">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>
                                    E-Mail:
                                </label>
                                <input name="email" type="email" class="form-control" placeholder="E-Mail Adresse:">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>
                                    Phone number: <span class="text-danger fw-bold">*</span>
                                </label>
                                <input name="telephone" type="text" class="form-control" placeholder="Phone number:">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>
                                    City:
                                </label>
                                <input name="ville" type="text" class="form-control" placeholder="City:">
                            </div>
                        </div>

                    </div>
                    <!-- row -->
                </div>
                <!-- card-body -->
            </div>
            <!-- card -->
        </div>
        <!-- col -->

        <div class="col-md-4">
            <h3>Payement Summary</h3>

            <div class="p-3 bg-light">

                <ul class="bg-transparent list-group">
                    <li class="bg-transparent list-group-item d-flex justify-content-between align-items-start">

                        <div class="ms-2 me-auto">

                            <div class="fw-bold">Order Summary:</div>

                        </div>

                        <span class="badge bg-dark rounded-pill"> <?= _numbrer_format($order_summary) ?></span>

                    </li>




                </ul>

                <button name="proced_to_checkout" type="submit" class="btn btn-info fw-bold text-white mt-3 rounded-pill">
                    PROCED TO CHECKOUT
                </button>
            </div>



        </div>

    </div>
</form>

<?php $content_html = ob_get_clean(); ?>