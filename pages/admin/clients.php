<?php

ob_start();
// php
$title = "Clients";

$clients = $pdo->query("SELECT * FROM users WHERE role_id = 3  ORDER BY id DESC;")->fetchAll();

// dd($clients);


if (isset($_POST['client_add'])) {
    $nom = _string($_POST['nom']);
    $req = $pdo->prepare('SELECT id FROM users WHERE nom = ? LIMIT 1');
    $req->execute([$nom]);
    $maruqe = $req->fetch();

    if (empty($_POST['nom']) or !preg_match('/^[0-9a-zA-Z ]+$/', $_POST['nom']) or $maruqe or strlen($_POST['nom']) < 2 or strlen($_POST['nom']) > 20) {

        if (empty($_POST['nom'])) {
            $errors["nom"] = "Veuillez saisir le nom de la client SVP ";
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
            $errors["nom"] = 'Cette client est déjà existe';
        }

        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    }

    // dd($_POST['nom']);
    // die();


    if (empty($errors)) {
        $user = $pdo->prepare("INSERT INTO clients SET 
                nom = :nom
        ");
        $user->execute(
            [
                'nom' => $nom
            ]
        );
        $_SESSION['flash']['success'] = 'Bien enregister';
        header('Location: clients');
        die();
    }
}


if (isset($_POST['client_update'])) {

    $id = (int)$_POST['client_id'];
    $nom = _string($_POST['nom']);
    $req = $pdo->prepare('SELECT id FROM users WHERE nom = ? LIMIT 1');
    $req->execute([$nom]);
    $client = $req->fetch();

    if (empty($_POST['nom']) or !preg_match('/^[0-9a-zA-Z ]+$/', $_POST['nom']) or $client or strlen($_POST['nom']) < 2 or strlen($_POST['nom']) > 20) {

        if (empty($_POST['nom'])) {
            $errors["nom"] = "Veuillez saisir le nom de la client SVP ";
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

        if ($client) {
            $errors["nom"] = 'Cette client est déjà existe';
        }

        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    }

    // dd($_POST['nom']);
    // die();


    if (empty($errors)) {
        $user = $pdo->prepare("UPDATE clients SET 
                nom = :nom WHERE id = :id
        ");
        $user->execute(
            [
                'id' => $id,
                'nom' => $nom
            ]
        );
        $_SESSION['flash']['success'] = 'Bien modifier';
        header('Location: clients');
        die();
    }
}

if (isset($_POST['client_desactivated'])) {

    $id = (int)$_POST['client_id'];
    if ($id != 1) {
        $pdo->query("UPDATE users SET activated = 0 WHERE id = $id");
        $_SESSION['flash']['success'] = 'Bien désactivé';
    } else {
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit de supprimer les données";
    }

    header('Location: clients');
    die();
}

if (isset($_POST['client_activated'])) {

    $id = (int)$_POST['client_id'];
    if ($id != 1) {
        $pdo->query("UPDATE users SET activated = 1 WHERE id = $id");
        $_SESSION['flash']['success'] = 'Bien désactivé';
    } else {
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit de supprimer les données";
    }

    header('Location: clients');
    die();
}

$content_php = ob_get_clean();

ob_start(); ?>

<h3>Clients</h3>


<div class="card shadow-sm">
    <div class="card-header">
        <h4>Liste des clients</h4>
    </div>

    <div class="card-body">

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger shadow mb-4">
                <h6>
                    <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#121331,secondary:#ed1c24" stroke="75" scale="40" style="width:50px;height:50px">
                    </lord-icon>
                    Vous n'avez pas rempli le formulaire correctement
                </h6>

                <ul class="list-group list-group-flush">
                    <?php foreach ($errors as $key => $e) : ?>
                        <li class="list-group-item bg-transparent">
                            <b><?= ucfirst($key) ?></b> - <?= $e ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>



        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#client_add">
            <i class="fas fa-plus"></i>
            Ajouter
        </button>

        <div class="modal fade" id="client_add" tabindex="-1" aria-labelledby="client_addLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="client_addLabel">
                            <i class="fas fa-plus"></i> Ajouter un client
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="nom" class="form-label">Client</label>

                                <input name="nom" type="text" class="form-control <?= $nom_class_input ?? "" ?>" id="nom" placeholder="Client">

                                <div class="<?= $nom_class_feedback ?? "" ?> fw-bold">
                                    <?= $errors['nom'] ?? "" ?>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-undo"></i>
                                Retour
                            </button>
                            <button type="submit" name="client_add" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover table-sm table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $key => $r) : ?>
                        <tr>
                            <th>
                                <?= $r->id ?>
                            </th>
                            <td>
                                <?= strtoupper($r->prenom) ?>
                            </td>
                            <td>
                                <?= strtoupper($r->nom) ?>
                            </td>

                            <td>
                                <?= $r->email ?>
                            </td>

                            <td>
                                <?= $r->telephone ?>
                            </td>
                            <td>
                                <span class="badge text-bg-<?= $r->activated ? "success" : "danger" ?>"><?= $r->activated ? "Activated" : "Disabled" ?></span>
                            </td>
                            <td>


                                <button type="button" class="btn btn-outline-dark fw-bold btn-sm" data-bs-toggle="modal" data-bs-target="#client_update_<?= $r->id ?>">
                                    <i class="fas fa-wrench"></i>
                                    Modifier
                                </button>

                                <div class="modal fade" id="client_update_<?= $r->id ?>" tabindex="-1" aria-labelledby="client_update_<?= $r->id ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="client_update_<?= $r->id ?>Label">
                                                    <i class="fas fa-wrench"></i>
                                                    Modifier <?= strtolower($r->nom) ?>
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post">
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="nom" class="form-label">Client</label>

                                                        <input name="nom" type="text" class="form-control" id="nom" value="<?= strtoupper($r->nom) ?>" placeholder="Client">

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-undo"></i>
                                                        Retour
                                                    </button>
                                                    <input type="hidden" name="client_id" value="<?= $r->id ?>">
                                                    <button type="submit" name="client_update" class="btn btn-dark">
                                                        <i class="fas fa-wrench"></i>
                                                        Modifier
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <?php if ($r->activated == 1) : ?>

                                    <button type="button" class="btn btn-outline-danger fw-bold btn-sm" data-bs-toggle="modal" data-bs-target="#client_desactivated_<?= $r->id ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Désactivé
                                    </button>

                                    <div class="modal fade" id="client_desactivated_<?= $r->id ?>" tabindex="-1" aria-labelledby="label_<?= $r->id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="label_<?= $r->id ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Désactivé
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-danger fw-bold h5"> Voulez vous vraiment désactiver <?= ucfirst($r->prenom) ?> <?= ucfirst($r->nom) ?> ?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-undo"></i>
                                                        Retour
                                                    </button>

                                                    <form method="post" style="display: inline;">
                                                        <input type="hidden" name="client_id" value="<?= $r->id ?>">
                                                        <button name="client_desactivated" type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Desactivé
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <button type="button" class="btn btn-outline-success fw-bold btn-sm" data-bs-toggle="modal" data-bs-target="#client_activated_<?= $r->id ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Activé
                                    </button>

                                    <div class="modal fade" id="client_activated_<?= $r->id ?>" tabindex="-1" aria-labelledby="label_<?= $r->id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="label_<?= $r->id ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Activé
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-success fw-bold h5"> Voulez vous vraiment activé <?= ucfirst($r->prenom) ?> <?= ucfirst($r->nom) ?> ?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-undo"></i>
                                                        Retour
                                                    </button>

                                                    <form method="post" style="display: inline;">
                                                        <input type="hidden" name="client_id" value="<?= $r->id ?>">
                                                        <button name="client_activated" type="submit" class="btn btn-success">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Activé
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>








                            </td>
                        </tr>
                    <?php endforeach  ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $content_html = ob_get_clean(); ?>