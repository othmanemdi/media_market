<?php

ob_start();
// php
$title = "Couleurs";

$couleurs = $pdo->query("SELECT * FROM couleurs ORDER BY id DESC;")->fetchAll();

// dd($couleurs);


if (isset($_POST['couleur_delete'])) {

    $id = (int)$_POST['couleur_id'];
    $pdo->query("DELETE FROM couleurs WHERE id = $id");
    $_SESSION['flash']['success'] = 'Bien supprimer';
    header('Location: couleurs');
    die();
}

$content_php = ob_get_clean();


ob_start(); ?>

<h3 class="mb-3">Couleurs</h3>


<div class="card shadow-sm">
    <div class="card-header">
        <h4>Liste des couleurs</h4>
    </div>

    <div class="card-body">
        <a href="couleur_add" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i>
            Ajouter
        </a>

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
                    <?php foreach ($couleurs as $key => $m) : ?>
                        <tr>
                            <th>
                                <?= $m->id ?>
                            </th>
                            <td>
                                <?= strtoupper($m->nom) ?>
                            </td>
                            <td>
                                <a href="couleur_update&id=<?= $m->id ?>" class="btn btn-dark btn-sm">
                                    <i class="fas fa-wrench"></i>
                                    Modifier
                                </a>




                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#couleur_delete_<?= $m->id ?>">
                                    <i class="fas fa-trash-alt"></i>
                                    Supprimer
                                </button>

                                <div class="modal fade" id="couleur_delete_<?= $m->id ?>" tabindex="-1" aria-labelledby="label_<?= $m->id ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="label_<?= $m->id ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Supprimer
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-danger fw-bold h5"> Voulez vous vraiment supprimer <?= strtoupper($m->nom) ?> ?</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-undo"></i>
                                                    Retour
                                                </button>

                                                <form method="post" style="display: inline;">
                                                    <input type="hidden" name="couleur_id" value="<?= $m->id ?>">
                                                    <button name="couleur_delete" type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>








                            </td>
                        </tr>
                    <?php endforeach  ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $content_html = ob_get_clean(); ?>