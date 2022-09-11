<?php

ob_start();
// php
$title = "Ajouter une nouvelle catégorie";

$errors = [];

if (isset($_POST['categorie_add'])) {
    $nom = _string($_POST['nom']);
    $req = $pdo->prepare('SELECT id FROM categories WHERE nom = ? LIMIT 1');
    $req->execute([$nom]);
    $categorie = $req->fetch();

    if (empty($_POST['nom']) or !preg_match('/^[0-9a-zA-Z ]+$/', $_POST['nom']) or $categorie or strlen($_POST['nom']) < 2 or strlen($_POST['nom']) > 20) {

        if (empty($_POST['nom'])) {
            $errors["nom"] = "Veuillez saisir le nom de la catégorie SVP ";
        }
        if (!preg_match('/^[0-9a-zA-Z ]+$/', $_POST['nom'])) {
            $errors["nom"] = "Veuillez entrer des caractères alphabétique ";
        }

        if (strlen($_POST['nom']) < 2) {
            $errors["nom"] = "Veuillez entrer plus que 1 caractère ";
        }

        if (strlen($_POST['nom']) > 20) {
            $errors["nom"] = "Veuillez entrer moin que 20 caractères ";
        }

        if ($categorie) {
            $errors["nom"] = 'Cette catégorie est déjà existe';
        }

        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    }

    // dd($_POST['nom']);
    // die();


    if (empty($errors)) {
        $user = $pdo->prepare("INSERT INTO categories SET 
                nom = :nom
        ");
        $user->execute(
            [
                'nom' => $nom
            ]
        );
        $_SESSION['flash']['success'] ='Bien enregister';
        header('Location: categories');
        die();
    }
}

$content_php = ob_get_clean();


ob_start(); ?>

<h3 class="mb-3">أضف فئة جديدة</h3>


<div class="row justify-content-md-center ">
    <div class="col-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>ضف فئة جديدة  </h4>
            </div>

            <div class="card-body">
                <a href="categories" class="btn btn-secondary mb-3">
                    <i class="fas fa-undo"></i>
                    لائحة الفئات
                </a>

                <!-- <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger shadow mb-4">
                        <h5>
                            Vous n'avez pas rempli le formulaire correctement
                        </h5>

                        <ul class="list-group list-group-flush">
                            <?php foreach ($errors as $key => $e) : ?>
                                <li class="list-group-item bg-transparent">
                                    <b><?= ucfirst($key) ?></b> - <?= $e ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?> -->

                <form method="post">
                    <div class="mb-3">
                        <label for="nom" class="form-label">فئة</label>

                        <input name="nom" type="text" class="form-control <?= $nom_class_input ?? "" ?>" id="nom" placeholder="Catégorie">

                        <div class="<?= $nom_class_feedback ?? "" ?> fw-bold">
                            <?= $errors['nom'] ?? "" ?>
                        </div>
                    </div>

                    <button type="submit" name="categorie_add" class="btn btn-success"> <i class="fa-solid fa-plus"></i> أضف</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php $content_html = ob_get_clean(); ?>