<?php

ob_start();
// php
$title = "Fournisseurs";

$fournisseurs = $pdo->query("SELECT * FROM users WHERE role_id = 2  ORDER BY id DESC;")->fetchAll();

// dd($fournisseurs);


if (isset($_POST['fournisseur_add'])) {

    if (empty($_POST['prenom']) or !preg_match('/^[a-zA-Z]+$/', $_POST['prenom']) or strlen($_POST['prenom']) < 3) {
        // $errors["prenom"] = "Votre prénome n'est pas valide";
        $errors["prenom"] = "";
        if (empty($_POST['prenom'])) {
            $errors["prenom"] .= "Veuillez saisir votre prenom SVP ";
        } else {

            if (!preg_match('/^[a-zA-Z]+$/', $_POST['prenom'])) {
                $errors["prenom"] .= "Veuillez entrer des caractères alphabétique ";
            }
            if (strlen($_POST['prenom']) < 3) {
                $errors["prenom"] .= "Veuillez entrer plus de 3 caractères ";
            }
        }
        $prenom_class_input = "is-invalid";
        $prenom_class_feedback = "invalid-feedback";
    } else {
        $prenom_class_input = "is-valid";
        $prenom_class_feedback = "valid-feedback";
    }

    if (empty($_POST['nom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['nom'])) {
        $errors["nom"] = "Votre nom n'est pas valide";
        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    } else {
        $nom_class_input = "is-valid";
        $nom_class_feedback = "valid-feedback";
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Votre email n'est pas valide";
        $email_class_input = "is-invalid";
        $email_class_feedback = "invalid-feedback";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();

        if ($user) {
            $errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
            $email_class_input = "is-invalid";
            $email_class_feedback = "invalid-feedback";
        } else {
            $email_class_input = "is-valid";
            $email_class_feedback = "valid-feedback";
        }
    }

    if (empty($_POST['telephone']) || !preg_match('/^[0-9 +]+$/', $_POST['telephone'])) {
        $errors["telephone"] = "Votre téléphone n'est pas valide";
        $telephone_class_input = "is-invalid";
        $telephone_class_feedback = "invalid-feedback";
    } else {
        $telephone_class_input = "is-valid";
        $telephone_class_feedback = "valid-feedback";
    }

    if (empty($_POST['password']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password'])) {
        $errors["password"] = "Votre password n'est pas valide";
        $password_class_input = "is-invalid";
        $password_class_feedback = "invalid-feedback";
    } else {
        $password_class_input = "is-valid";
        $password_class_feedback = "valid-feedback";
    }

    if (empty($_POST['password_confirm']) || ($_POST['password'] != $_POST['password_confirm'])) {
        $errors["password_confirm"] = "Les deux mots de passe ne sont pas identiques";
        $password_confirm_class_input = "is-invalid";
        $password_confirm_class_feedback = "invalid-feedback";
    } else {
        $password_confirm_class_input = "is-valid";
        $password_confirm_class_feedback = "valid-feedback";
    }

    if (empty($errors)) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $prenom = _string($_POST['prenom']);
        $nom = _string($_POST['nom']);
        $email = _string($_POST['email']);
        $telephone = _string($_POST['telephone']);
        $password = _string($_POST['password']);
        $req = $pdo->prepare("INSERT INTO users SET
            prenom = ?,
            nom = ?,
            email = ?,
            telephone = ?,
            password = ?,
            role_id = ?
         ");
        $req->execute(
            [
                $prenom,
                $nom,
                $email,
                $telephone,
                $password,
                2
            ]
        );
        // $user_id = $pdo->lastInsertId();

        $_SESSION['flash']['success'] = 'Bien enregister';
        header('Location: fournisseurs');
        exit();
    }
}

if (isset($_POST['fournisseur_update'])) {

    if (empty($_POST['prenom']) or !preg_match('/^[a-zA-Z]+$/', $_POST['prenom']) or strlen($_POST['prenom']) < 3) {
        // $errors["prenom"] = "Votre prénome n'est pas valide";
        $errors["prenom"] = "";
        if (empty($_POST['prenom'])) {
            $errors["prenom"] .= "Veuillez saisir votre prenom SVP ";
        } else {

            if (!preg_match('/^[a-zA-Z]+$/', $_POST['prenom'])) {
                $errors["prenom"] .= "Veuillez entrer des caractères alphabétique ";
            }
            if (strlen($_POST['prenom']) < 3) {
                $errors["prenom"] .= "Veuillez entrer plus de 3 caractères ";
            }
        }
        $prenom_class_input = "is-invalid";
        $prenom_class_feedback = "invalid-feedback";
    } else {
        $prenom_class_input = "is-valid";
        $prenom_class_feedback = "valid-feedback";
    }

    if (empty($_POST['nom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['nom'])) {
        $errors["nom"] = "Votre nom n'est pas valide";
        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    } else {
        $nom_class_input = "is-valid";
        $nom_class_feedback = "valid-feedback";
    }

    if (empty($_POST['telephone']) || !preg_match('/^[0-9 +]+$/', $_POST['telephone'])) {
        $errors["telephone"] = "Votre téléphone n'est pas valide";
        $telephone_class_input = "is-invalid";
        $telephone_class_feedback = "invalid-feedback";
    } else {
        $telephone_class_input = "is-valid";
        $telephone_class_feedback = "valid-feedback";
    }


    $id = (int)$_POST['fournisseur_id'];

    $fournisseur_role = $pdo->query("SELECT role_id FROM users WHERE id = $id LIMIT 1")->fetch()->role_id;

    if ($fournisseur_role != 2) {
        $errors["role_id"] = "Error";
    }

    if (empty($errors)) {
        $prenom = _string($_POST['prenom']);
        $nom = _string($_POST['nom']);
        $telephone = _string($_POST['telephone']);

        $req = $pdo->prepare("UPDATE users SET
            prenom = :prenom,
            nom = :nom,
            telephone = :telephone
            WHERE id = :id AND role_id = 2
         ");
        $req_execute = $req->execute(
            [
                'prenom' => $prenom,
                'nom' => $nom,
                'telephone' => $telephone,
                'id' => $id
            ]
        );
        // $user_id = $pdo->lastInsertId();

        $_SESSION['flash']['success'] = 'Bien modifier';
        header('Location: fournisseurs');
        exit();
    }
}

if (isset($_POST['fournisseur_desactivated'])) {

    $id = (int)$_POST['fournisseur_id'];
    if ($id != 1) {
        $pdo->query("UPDATE users SET activated = 0 WHERE id = $id");
        $_SESSION['flash']['success'] = 'Bien désactivé';
    } else {
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit de supprimer les données";
    }

    header('Location: fournisseurs');
    die();
}

if (isset($_POST['fournisseur_activated'])) {

    $id = (int)$_POST['fournisseur_id'];
    if ($id != 1) {
        $pdo->query("UPDATE users SET activated = 1 WHERE id = $id");
        $_SESSION['flash']['success'] = 'Bien désactivé';
    } else {
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit de supprimer les données";
    }

    header('Location: fournisseurs');
    die();
}

$content_php = ob_get_clean();

ob_start(); ?>

<h3>Fournisseurs</h3>


<div class="card shadow-sm">
    <div class="card-header">
        <h4>Liste des fournisseurs</h4>
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



        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#fournisseur_add">
            <i class="fas fa-plus"></i>
            Ajouter
        </button>

        <div class="modal fade" id="fournisseur_add" tabindex="-1" aria-labelledby="fournisseur_addLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="fournisseur_addLabel">
                            <i class="fas fa-plus"></i> Ajouter un fournisseur
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" autocomplete="off">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="prenom">Prénom:</label>

                                        <input name="prenom" type="text" class="form-control <?= $prenom_class_input ?? "" ?>" id="prenom" placeholder="Prénom" value="<?= $_POST['prenom'] ?? "" ?>">

                                        <div class="<?= $prenom_class_feedback ?? "" ?> fw-bold">
                                            <?= $errors['prenom'] ?? "" ?>
                                        </div>

                                    </div>
                                </div>
                                <!-- col -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="nom">Nom:</label>

                                        <input name="nom" type="text" class="form-control <?= $nom_class_input ?? "" ?>" id="nom" placeholder="Nom:" value="<?= $_POST['nom'] ?? "" ?>">

                                        <div class="<?= $nom_class_feedback ?? "" ?> fw-bold">
                                            <?= $errors['nom'] ?? "" ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- col -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="email">Adresse mail:</label>

                                        <input name="email" type="email" class="form-control <?= $email_class_input ?? "" ?>" id="email" name="email" placeholder="Email:" value="@gmail.com">

                                        <div class="<?= $email_class_feedback ?? "" ?> fw-bold">
                                            <?= $errors['email'] ?? "" ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- col -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="email">Téléphone:</label>

                                        <input name="telephone" type="text" class="form-control <?= $telephone_class_input ?? "" ?>" id="telephone" name="telephone" placeholder="Téléphone:" value="<?= $_POST['telephone'] ?? "" ?>">

                                        <div class="<?= $telephone_class_feedback ?? "" ?> fw-bold">
                                            <?= $errors['telephone'] ?? "" ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- col -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="password">Mot de passe:</label>

                                        <input name="password" type="password" class="form-control <?= $password_class_input ?? "" ?>" id="password" name="password" placeholder="Mot de passe" value="123456">

                                        <div class="<?= $password_class_feedback ?? "" ?> fw-bold">
                                            <?= $errors['password'] ?? "" ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="password_confirm">Confirmer le mot de passe:</label>

                                        <input name="password_confirm" type="password" class="form-control <?= $password_confirm_class_input ?? "" ?>" id="password_confirm" name="password_confirm" placeholder="Confirmer le mot de passe!" value="123456">

                                        <div class="<?= $password_confirm_class_feedback ?? "" ?> fw-bold">
                                            <?= $errors['password_confirm'] ?? "" ?>
                                        </div>
                                    </div>
                                    <!-- col -->
                                </div>
                                <!-- row -->

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-undo"></i>
                                Retour
                            </button>
                            <button type="submit" name="fournisseur_add" class="btn btn-primary">
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
                    <?php foreach ($fournisseurs as $key => $r) : ?>
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


                                <button type="button" class="btn btn-outline-dark fw-bold btn-sm" data-bs-toggle="modal" data-bs-target="#fournisseur_update_<?= $r->id ?>">
                                    <i class="fas fa-wrench"></i>
                                    Modifier
                                </button>

                                <div class="modal fade" id="fournisseur_update_<?= $r->id ?>" tabindex="-1" aria-labelledby="fournisseur_update_<?= $r->id ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="fournisseur_update_<?= $r->id ?>Label">
                                                    <i class="fas fa-wrench"></i>
                                                    Modifier <?= strtolower($r->nom) ?>
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post">
                                                <div class="modal-body">


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="prenom">Prénom:</label>

                                                                <input name="prenom" type="text" class="form-control" placeholder="Prénom" value="<?= strtoupper($r->prenom) ?>">

                                                            </div>
                                                        </div>
                                                        <!-- col -->
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="nom">Nom:</label>

                                                                <input name="nom" type="text" class="form-control" id="nom" placeholder="Nom:" value="<?= strtoupper($r->nom) ?>">

                                                            </div>
                                                        </div>
                                                        <!-- col -->

                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="email">Téléphone:</label>

                                                                <input name="telephone" type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone:" value="<?= $r->telephone ?>">

                                                            </div>
                                                        </div>
                                                        <!-- col -->


                                                    </div>
                                                    <!-- row -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-undo"></i>
                                                        Retour
                                                    </button>
                                                    <input type="hidden" name="fournisseur_id" value="<?= $r->id ?>">
                                                    <button type="submit" name="fournisseur_update" class="btn btn-dark">
                                                        <i class="fas fa-wrench"></i>
                                                        Modifier
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <?php if ($r->activated == 1) : ?>

                                    <button type="button" class="btn btn-outline-danger fw-bold btn-sm" data-bs-toggle="modal" data-bs-target="#fournisseur_desactivated_<?= $r->id ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Désactivé
                                    </button>

                                    <div class="modal fade" id="fournisseur_desactivated_<?= $r->id ?>" tabindex="-1" aria-labelledby="label_<?= $r->id ?>" aria-hidden="true">
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
                                                        <input type="hidden" name="fournisseur_id" value="<?= $r->id ?>">
                                                        <button name="fournisseur_desactivated" type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Desactivé
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <button type="button" class="btn btn-outline-success fw-bold btn-sm" data-bs-toggle="modal" data-bs-target="#fournisseur_activated_<?= $r->id ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Activé
                                    </button>

                                    <div class="modal fade" id="fournisseur_activated_<?= $r->id ?>" tabindex="-1" aria-labelledby="label_<?= $r->id ?>" aria-hidden="true">
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
                                                        <input type="hidden" name="fournisseur_id" value="<?= $r->id ?>">
                                                        <button name="fournisseur_activated" type="submit" class="btn btn-success">
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