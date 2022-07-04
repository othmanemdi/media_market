<?php

ob_start();
// php
$title = "Product update";



if (!isset($_GET['id'])) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: products');
    die();
}

$product_id = (int)$_GET['id'];

if ($product_id == 0) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: products');
    die();
}

if (isset($_POST['add_image'])) {
    // dd($_FILES);

    $produt_id = 1;
    $target_dir = "images/products/";

    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $image_name =  basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

    // var_dump();
    $extention_image = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // dd();
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extentions = ["jpeg", "jpg"];
    if (!in_array($extention_image, $extentions)) {
        $_SESSION['flash']['danger'] = "Cette extention n'est pas valide (.$extention_image) Seule les images sont autorisez";
        header('Location: produit_add');
        die();
    }


    // die();
    // Check if image file is a actual image or fake image
    // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    // if ($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    // } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }


    // if (empty($errors)) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {



        $ranking = $pdo->query("SELECT ranking FROM product_images 
            WHERE product_id = $product_id
            ORDER BY ranking DESC
        LIMIT 1;")->fetch()->ranking + 1;


        $image_add = $pdo->prepare("INSERT INTO product_images SET 
                nom = :nom,
                product_id = :product_id,
                ranking = :ranking
        ");
        $image_add->execute(
            [
                'nom' => $image_name,
                'product_id' => $product_id,
                'ranking' => $ranking
            ]
        );
        $_SESSION['flash']['success'] = 'Bien enregister';
        header("Location: product_update&id=$product_id");
        die();
        // echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    }
    // else {
    //     // echo "Sorry, there was an error uploading your file.";
    // }
    // }

}

$product = $pdo->query("SELECT 
    p.id As product_id,
    p.nom As product_nom,
    p.reference,
    p.prix,
    p.ancien_prix,
    m.nom As marque_nom,
    c.nom As categorie_nom,
    cr.nom As couleur_nom,
    p.activated

    FROM products p

        LEFT JOIN marques m ON m.id = p.marque_id
        LEFT JOIN categories c ON c.id = p.categorie_id
        LEFT JOIN couleurs cr ON cr.id = p.couleur_id
WHERE p.id = $product_id

 LIMIT 1;")->fetch();


$images = $pdo->query("SELECT id,nom,ranking FROM product_images WHERE product_id = $product_id ORDER BY ranking ASC;")->fetchAll();

// dd($product);
$content_php = ob_get_clean();


ob_start(); ?>

<h3>Product update page</h3>



<div class="card shadow mb-3">
    <div class="card-body">

        <dl class="row">
            <dt class="col-sm-3">
                Référence:
            </dt>
            <dd class="col-sm-9">
                <?= strtoupper($product->reference) ?>
            </dd>

            <dt class="col-sm-3">
                Nom:
            </dt>
            <dd class="col-sm-9">
                <?= strtoupper($product->product_nom) ?>
            </dd>


            <dt class="col-sm-3">
                Prix:
            </dt>
            <dd class="col-sm-9">

                <?= _numbrer_format($product->prix) ?> DH <del class="text-danger">
                    <?= _numbrer_format($product->ancien_prix) ?> DH
                </del>

            </dd>




            <dt class="col-sm-3">
                Marque:
            </dt>
            <dd class="col-sm-9">
                <?= strtoupper($product->marque_nom) ?>
            </dd>



            <dt class="col-sm-3">
                Catégorie:
            </dt>
            <dd class="col-sm-9">
                <?= strtoupper($product->categorie_nom) ?>
            </dd>


            <dt class="col-sm-3">
                Couleur:
            </dt>
            <dd class="col-sm-9">
                <?= strtoupper($product->couleur_nom) ?>
            </dd>

        </dl>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#image_product_add">
            <i class="fas fa-image"></i>
            Ajouter une nouvelle image</button>

        <div class="modal fade" id="image_product_add" tabindex="-1" aria-labelledby="image_product_addLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="image_product_addLabel">
                            <i class="fas fa-image"></i>
                            Ajouter une nouvelle image
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" name="fileToUpload" class="form-control" id="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Feremer</button>
                            <button name="add_image" type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Ajouter
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Ranking</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($images as $k => $img) : ?>
                        <tr>
                            <td>
                                <?= $img->id ?>
                            </td>
                            <td>
                                <img src="../images/products/<?= $img->nom ?>" class="d-block" width="40" alt="...">
                            </td>
                            <td>
                                <?= $img->ranking ?>
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-danger">
                                    Supprimer
                                </a>
                            </td>

                        </tr>

                    <?php endforeach  ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $content_html = ob_get_clean(); ?>