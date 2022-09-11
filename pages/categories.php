<?php

ob_start();
// php
$title = "Catégories";

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// dd($categories);

$content_php = ob_get_clean();


ob_start(); ?>

<h3 class="mb-3">الفئات</h3>


<div class="card shadow-sm">
    <div class="card-header">
        <h4>لائحة الفئات</h4>
    </div>

    <div class="card-body">
        <a href="categorie_add" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i>
            أضف</a>

        <div class="table-responsive">

            <table class="table table-bordered table-hover table-sm table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>الاسم</th>
                        <th>الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $key => $c) : ?>
                        <tr>
                            <th>
                                <?= $c->id ?>
                            </th>
                            <td>
                                <?= strtoupper($c->nom) ?>
                            </td>
                            <td>
                                <a href="categorie_update&id=<?= $c->id ?>" class="btn btn-dark btn-sm">
                                    <i class="fas fa-wrench"></i>
                                    تعديل
                                </a>
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                    حذف
                                </button>
                            </td>
                        </tr>
                    <?php endforeach  ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $content_html = ob_get_clean(); ?>