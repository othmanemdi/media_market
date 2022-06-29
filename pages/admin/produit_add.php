<?php

ob_start();
// php
$title = "Add a new product";
$errors = [];
if (isset($_POST['add_product'])) {

    $nom = _string($_POST['nom']);
    $reference = _string($_POST['reference']);
    $prix = (float)$_POST['prix'];
    $ancien_prix = (float)$_POST['ancien_prix'];
    $marque_id = (int)$_POST['marque'];
    $categorie_id = (int)$_POST['categorie'];
    $couleur_id = (int)$_POST['couleur'];

    if (isset($_POST['activated']))
        $activated = 1;
    else
        $activated = 0;


    $user = $pdo->prepare("INSERT INTO products SET 
        nom = :nom,
        reference = :reference,
        prix = :prix,
        ancien_prix = :ancien_prix,
        marque_id = :marque_id,
        categorie_id = :categorie_id,
        couleur_id = :couleur_id,
        activated = :activated
");
    $user->execute(
        [
            'nom' => $nom,
            'reference' => $reference,
            'prix' => $prix,
            'ancien_prix' => $ancien_prix,
            'marque_id' => $marque_id,
            'categorie_id' => $categorie_id,
            'couleur_id' => $couleur_id,
            'activated' => $activated
        ]
    );

    $product_id = $pdo->lastInsertId();


    $_SESSION['flash']['success'] = 'Bien enregister';
    header('Location: product_update&id=' . $product_id);
    die();
}

$marques = $pdo->query("SELECT * FROM marques ")->fetchAll();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$couleurs = $pdo->query("SELECT * FROM couleurs ")->fetchAll();



$content_php = ob_get_clean();


ob_start(); ?>

<h3>Add a new product</h3>


<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom:">
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="reference" class="form-label">Référence:</label>
                        <input type="text" class="form-control" id="reference" name="reference" placeholder="Référence:">
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="prix" class="form-label">Prix:</label>
                        <input type="number" class="form-control" id="prix" name="prix" placeholder="Prix:">
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="ancien_prix" class="form-label">Ancien prix:</label>
                        <input type="number" class="form-control" id="ancien_prix" name="ancien_prix" placeholder="Ancien prix:">
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="marque" class="form-label">Marques:</label>

                        <select class="form-select" id="marque" name="marque" aria-label="Default select example">
                            <option disabled hidden selected>Shows your marque:</option>
                            <?php foreach ($marques as $key => $m) : ?>
                                <option value="<?= $m->id ?>">
                                    <?= strtoupper($m->nom) ?>
                                </option>
                            <?php endforeach  ?>

                        </select>

                    </div>
                </div>

                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="categorie" class="form-label">Catégories:</label>

                        <select class="form-select" id="categorie" name="categorie" aria-label="Default select example">
                            <option disabled hidden selected>Shows your categories:</option>
                            <?php foreach ($categories as $key => $m) : ?>
                                <option value="<?= $m->id ?>">
                                    <?= strtoupper($m->nom) ?>
                                </option>
                            <?php endforeach  ?>

                        </select>

                    </div>
                </div>


                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="couleur" class="form-label">Couleurs:</label>

                        <select class="form-select" id="couleur" name="couleur" aria-label="Default select example">
                            <option disabled hidden selected>Shows your couleur:</option>
                            <?php foreach ($couleurs as $key => $m) : ?>
                                <option value="<?= $m->id ?>">
                                    <?= strtoupper($m->nom) ?>
                                </option>
                            <?php endforeach  ?>

                        </select>

                    </div>
                </div>

                <!-- 
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="fileToUpload" class="form-label">Image:</label>
                        <input type="file" class="form-control" id="fileToUpload" name="fileToUpload">
                    </div>
                </div> -->

                <div class="col-md-12">

                    <div class="mb-3">
                        <label for="image_produit" class="form-label">Image:</label>
                        <textarea class="form-control" placeholder="Description:" name="" id="" cols="10" rows="3"></textarea>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="form-check">
                        <input name="activated" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Active
                        </label>
                    </div>
                </div>

            </div>

            <button type="submit" name="add_product" class="btn btn-primary mt-3">Ajouter un nouveau product</button>
        </form>
    </div>


</div>





<?php $content_html = ob_get_clean(); ?>