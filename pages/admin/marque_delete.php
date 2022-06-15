<?php

ob_start();
// php
$title = "Supprimer une marque";

if (!isset($_GET['id'])) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: marques');
    die();
}

$id = (int)$_GET['id'];

if ($id == 0) {
    $_SESSION['flash']['danger'] = 'Id introuvable';
    header('Location: marques');
    die();
}


$content_php = ob_get_clean();
