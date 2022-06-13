<?php

ob_start();
// php
$title = "Ajouter une nouvelle marque";

$errors = [];

if (isset($_POST['marque_add'])) {
    $nom = _string($_POST['nom']);
    $req = $pdo->prepare('SELECT id FROM marques WHERE nom = ? LIMIT 1');
    $req->execute([$nom]);
    $maruqe = $req->fetch();

    if (empty($_POST['nom']) or !preg_match('/^[0-9a-zA-Z ]+$/', $_POST['nom']) or $maruqe or strlen($_POST['nom']) < 2 or strlen($_POST['nom']) > 20) {

        if (empty($_POST['nom'])) {
            $errors["nom"] = "Veuillez saisir le nom de la marque SVP ";
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

        if ($maruqe) {
            $errors["nom"] = 'Cette marque est déjà existe';
        }

        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    }

    // dd($_POST['nom']);
    // die();


    if (empty($errors)) {
        $user = $pdo->prepare("INSERT INTO marques SET 
                nom = :nom
        ");
        $user->execute(
            [
                'nom' => $nom
            ]
        );
        $_SESSION['flash']['success'] = ' <i class="fa-solid fa-check"></i> Bien enregister';
        header('Location: marques');
        die();
    }
}

$content_php = ob_get_clean();


ob_start(); ?>

<h3 class="mb-3">Ajouter une nouvelle marque</h3>


<div class="row justify-content-md-center ">
    <div class="col-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Ajouter une nouvelle marque</h4>
            </div>

            <div class="card-body">
                <a href="marques" class="btn btn-secondary mb-3">
                    <i class="fas fa-undo"></i>
                    Liste des marques
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
                        <label for="nom" class="form-label">Marque</label>

                        <input name="nom" type="text" class="form-control <?= $nom_class_input ?? "" ?>" id="nom" placeholder="marque">

                        <div class="<?= $nom_class_feedback ?? "" ?> fw-bold">
                            <?= $errors['nom'] ?? "" ?>
                        </div>
                    </div>

                    <button type="submit" name="marque_add" class="btn btn-success">Ajouter</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php $content_html = ob_get_clean(); ?>