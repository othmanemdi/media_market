<?php

ob_start();
// php
$title = "Ajouter une nouvelle marque";

$content_php = ob_get_clean();


ob_start(); ?>

<h3 class="mb-3">Ajouter une nouvelle marque</h3>



<div class="card shadow-sm">
    <div class="card-header">
        <h4>Ajouter une nouvelle marque</h4>
    </div>

    <div class="card-body">
        <a href="marques" class="btn btn-secondary mb-3">
            <i class="fas fa-undo"></i>
            Liste des marques
        </a>

        <form method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Marque</label>
                <input type="text" class="form-control" id="nom" nom="nom" placeholder="Nike">
            </div>

            <button type="submit" name="marque_add" class="btn btn-success">Ajouter</button>
        </form>

    </div>
</div>

<?php $content_html = ob_get_clean(); ?>