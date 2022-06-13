<?php

ob_start();
// php
$title = "Supprimer la catégorie";

if (!isset($_GET['id'])) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: categories');
    die();
}

$id = (int)$_GET['id'];

if ($id == 0) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: categories');
    die();
}


$content_php = ob_get_clean();
