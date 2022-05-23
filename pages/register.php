<?php

ob_start();
// php
$errors = [];
// $errors = array();

if (isset($_POST['ajt_compte'])) {
    if (empty($_POST['prenom']) or !preg_match('/^[a-zA-Z]+$/', $_POST['prenom']) or strlen($_POST['prenom']) < 3) {
        // $errors["prenom"] = "Votre prénome n'est pas valide";
        $errors["prenom"] = "";
        if (empty($_POST['prenom'])) {
            $errors["prenom"] .= "Veuillez saisir votre prenom SVP";
        } else {

            if (!preg_match('/^[a-zA-Z]+$/', $_POST['prenom'])) {
                $errors["prenom"] .= "Veuillez entrer des caractères alphabétique";
            }
            if (strlen($_POST['prenom']) < 3) {
                $errors["prenom"] .= "Veuillez entrer plus de 3 caractères";
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
        $email_class_input = "is-valid";
        $email_class_feedback = "valid-feedback";
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
}

$title = "Register";

$content_php = ob_get_clean();

ob_start(); ?>


<div class="row justify-content-md-center">
    <div class="col-8">
        <div class="bg-light p-5 rounded-pilla rounded-3">
            <h2 class="text-center mb-4">CRÉER UN NOUVEAU COMPTE CLIENT </h2>

            <h3 class="text-center">Informations personnelles</h3>

            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger shadow mb-4">
                    <h5>
                        <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#121331,secondary:#ed1c24" stroke="75" scale="40" style="width:50px;height:50px">
                        </lord-icon>
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
            <?php endif ?>

            <form method="post" autocomplete="off">
                <div class="form-group mb-3">
                    <label class="form-label" for="prenom">Prénom:</label>

                    <input name="prenom" type="text" class="form-control <?= $prenom_class_input ?? "" ?>" id="prenom" placeholder="Veuillez saisir votre prénom SVP !" value="<?= $_POST['prenom'] ?? "" ?>">

                    <div class="<?= $prenom_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['prenom'] ?? "" ?>
                    </div>

                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="nom">Nom:</label>

                    <input name="nom" type="text" class="form-control <?= $nom_class_input ?? "" ?>" id="nom" placeholder="Veuillez saisir votre nom SVP !" value="<?= $_POST['nom'] ?? "" ?>">

                    <div class="<?= $nom_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['nom'] ?? "" ?>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="email">Adresse mail:</label>

                    <input name="email" type="text" class="form-control <?= $email_class_input ?? "" ?>" id="email" name="email" placeholder="Veuillez saisir votre adresse mail SVP !" value="<?= $_POST['email'] ?? "" ?>">

                    <div class="<?= $email_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['email'] ?? "" ?>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="password">Mot de passe:</label>

                    <input name="password" type="password" class="form-control <?= $password_class_input ?? "" ?>" id="password" name="password" placeholder="Veuillez saisir votre Mot de passe SVP !">

                    <div class="<?= $password_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['password'] ?? "" ?>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="password_confirm">Confirmer le mot de passe:</label>

                    <input name="password_confirm" type="password" class="form-control <?= $password_confirm_class_input ?? "" ?>" id="password_confirm" name="password_confirm" placeholder="Veuillez confirmer le mot de passe SVP !">

                    <div class="<?= $password_confirm_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['password_confirm'] ?? "" ?>
                    </div>
                </div>

                <button type="submit" name="ajt_compte" class="btn btn-info text-white">Créer un compte</button>
                <button class="btn btn-secondary">Retour</button>
            </form>
        </div>
    </div>

</div>
<?php $content_html = ob_get_clean(); ?>