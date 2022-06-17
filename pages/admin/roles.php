<?php

ob_start();
// php
$title = "Roles";

$roles = $pdo->query("SELECT * FROM roles ORDER BY id DESC;")->fetchAll();

// dd($roles);


if (isset($_POST['role_add'])) {
    $nom = _string($_POST['nom']);
    $req = $pdo->prepare('SELECT id FROM roles WHERE nom = ? LIMIT 1');
    $req->execute([$nom]);
    $maruqe = $req->fetch();

    if (empty($_POST['nom']) or !preg_match('/^[0-9a-zA-Z ]+$/', $_POST['nom']) or $maruqe or strlen($_POST['nom']) < 2 or strlen($_POST['nom']) > 20) {

        if (empty($_POST['nom'])) {
            $errors["nom"] = "Veuillez saisir le nom de la role SVP ";
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
            $errors["nom"] = 'Cette role est déjà existe';
        }

        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    }

    // dd($_POST['nom']);
    // die();


    if (empty($errors)) {
        $user = $pdo->prepare("INSERT INTO roles SET 
                nom = :nom
        ");
        $user->execute(
            [
                'nom' => $nom
            ]
        );
        $_SESSION['flash']['success'] = 'Bien enregister';
        header('Location: roles');
        die();
    }
}


if (isset($_POST['role_update'])) {

    $id = (int)$_POST['role_id'];
    $nom = _string($_POST['nom']);
    $req = $pdo->prepare('SELECT id FROM roles WHERE nom = ? LIMIT 1');
    $req->execute([$nom]);
    $role = $req->fetch();

    if (empty($_POST['nom']) or !preg_match('/^[0-9a-zA-Z ]+$/', $_POST['nom']) or $role or strlen($_POST['nom']) < 2 or strlen($_POST['nom']) > 20) {

        if (empty($_POST['nom'])) {
            $errors["nom"] = "Veuillez saisir le nom de la role SVP ";
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

        if ($role) {
            $errors["nom"] = 'Cette role est déjà existe';
        }

        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    }

    // dd($_POST['nom']);
    // die();


    if (empty($errors)) {
        $user = $pdo->prepare("UPDATE roles SET 
                nom = :nom WHERE id = :id
        ");
        $user->execute(
            [
                'id' => $id,
                'nom' => $nom
            ]
        );
        $_SESSION['flash']['success'] = 'Bien modifier';
        header('Location: roles');
        die();
    }
}

if (isset($_POST['role_delete'])) {

    $id = (int)$_POST['role_id'];
    if ($id > 3) {
        $pdo->query("DELETE FROM roles WHERE id = $id");
        $_SESSION['flash']['success'] = 'Bien supprimer';
    } else {
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit de supprimer les données";
    }

    header('Location: roles');
    die();
}

$content_php = ob_get_clean();

ob_start(); ?>

<h3>Roles</h3>


<div class="card shadow-sm">
    <div class="card-header">
        <h4>Liste des roles</h4>
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



        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#role_add">
            <i class="fas fa-plus"></i>
            Ajouter
        </button>

        <div class="modal fade" id="role_add" tabindex="-1" aria-labelledby="role_addLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="role_addLabel">
                            <i class="fas fa-plus"></i> Ajouter un role
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="nom" class="form-label">Role</label>

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
                            <button type="submit" name="role_add" class="btn btn-primary">
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
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $key => $r) : ?>
                        <tr>
                            <th>
                                <?= $r->id ?>
                            </th>
                            <td>
                                <?= strtoupper($r->nom) ?>
                            </td>
                            <td>


                                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#role_update_<?= $r->id ?>">
                                    <i class="fas fa-wrench"></i>
                                    Modifier
                                </button>

                                <div class="modal fade" id="role_update_<?= $r->id ?>" tabindex="-1" aria-labelledby="role_update_<?= $r->id ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="role_update_<?= $r->id ?>Label">
                                                    <i class="fas fa-wrench"></i>
                                                    Modifier <?= strtolower($r->nom) ?>
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post">
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="nom" class="form-label">Role</label>

                                                        <input name="nom" type="text" class="form-control" id="nom" value="<?= strtoupper($r->nom) ?>" placeholder="Client">

                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-undo"></i>
                                                        Retour
                                                    </button>
                                                    <input type="hidden" name="role_id" value="<?= $r->id ?>">
                                                    <button type="submit" name="role_update" class="btn btn-dark">
                                                        <i class="fas fa-wrench"></i>
                                                        Modifier
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <?php if ($r->id > 3) : ?>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#role_delete_<?= $r->id ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Supprimer
                                    </button>

                                    <div class="modal fade" id="role_delete_<?= $r->id ?>" tabindex="-1" aria-labelledby="label_<?= $r->id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="label_<?= $r->id ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Supprimer
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-danger fw-bold h5"> Voulez vous vraiment supprimer <?= strtoupper($r->nom) ?> ?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-undo"></i>
                                                        Retour
                                                    </button>

                                                    <form method="post" style="display: inline;">
                                                        <input type="hidden" name="role_id" value="<?= $r->id ?>">
                                                        <button name="role_delete" type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Supprimer
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