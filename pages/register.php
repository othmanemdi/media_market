<?php

ob_start();
// php
$title = "404";

$content_php = ob_get_clean();


ob_start(); ?>

<div class="row justify-content-md-center">
    <div class="col-8">
        <div class="bg-light p-5 rounded-pilla rounded-3 shadow border border-dark">
            <h2 class="text-center mb-4">CRÉER UN NOUVEAU COMPTE CLIENT </h2>

            <h3 class="text-center">Informations personnelles</h3>


            <form method="post" autocomplete="off">
                <div class="form-group mb-3">
                    <label class="form-label" for="prenom">Prénom:</label>

                    <input name="prenom" type="text" class="form-control border border-dark" id="prenom" placeholder="Veuillez saisir votre prénom SVP !" value="">

                    <div class=" fw-bold">
                    </div>

                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="nom">Nom:</label>

                    <input name="nom" type="text" class="form-control border border-dark" id="nom" placeholder="Veuillez saisir votre nom SVP !" value="">

                    <div class=" fw-bold">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="email">Adresse mail:</label>

                    <input name="email" type="text" class="form-control border border-dark" id="email" name="email" placeholder="Veuillez saisir votre adresse mail SVP !" value="">

                    <div class=" fw-bold">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="password">Mot de passe:</label>

                    <input name="password" type="password" class="form-control border border-dark" id="password" name="password" placeholder="Veuillez saisir votre Mot de passe SVP !">

                    <div class=" fw-bold">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="password_confirm">Confirmer le mot de passe:</label>

                    <input name="password_confirm" type="password" class="form-control border border-dark" id="password_confirm" name="password_confirm" placeholder="Veuillez confirmer le mot de passe SVP !">

                    <div class=" fw-bold">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button class="btn btn-dark"> <i class="fa-solid fa-arrow-left"></i> Retour</button>
                    <button type="submit" name="ajt_compte" class="btn btn-info text-white"> <i class="fa-solid fa-arrow-right-to-bracket"></i>  Créer un compte</button>
                </div>

            </form>
        </div>
    </div>

</div>


<?php $content_html = ob_get_clean(); ?>