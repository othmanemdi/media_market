<?php

ob_start();
// php
$title = "Commandes";


$commandes = $pdo->query("SELECT 
c.id As numero, 
c.date_commande,
u.prenom,
u.nom, 
u.telephone
FROM commandes c 
LEFT JOIN users u ON u.id = c.user_id

ORDER BY c.id DESC;")->fetchAll();

$content_php = ob_get_clean();


ob_start(); ?>


<h3>
    <i class="fa-solid fa-file-lines"></i>
    Commandes
</h3>

<div class="table-responsive">
    <table id="table" class="table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr class="table-dark">
                <th>Numéro</th>
                <th>Date</th>
                <th>Status</th>
                <th>Client</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($commandes as $key => $c) : ?>
                <tr>
                    <td>N° <?= $c->numero ?></td>
                    <td><?= $c->date_commande ?></td>
                    <td>
                        <span class="badge rounded-pill text-bg-info">New</span>
                    </td>
                    <td><?= ucfirst($c->prenom . " " . $c->nom)  ?></td>
                    <td><?= $c->telephone ?></td>
                    <td>
                        <a href="commande_details&id=<?= $c->numero ?>" class="btn btn-dark btn-sm">
                            <i class="fa-solid fa-file-lines"></i>
                            Afficher
                        </a>
                    </td>

                </tr>
            <?php endforeach  ?>
        </tbody>
    </table>
</div>


<?php $content_html = ob_get_clean();
