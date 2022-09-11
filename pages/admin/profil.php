<?php

ob_start();
// php
$title = "profil";


$content_php = ob_get_clean();

ob_start(); ?>

<h3>الصفحة الشخصية</h3>
<?php $content_html = ob_get_clean(); ?>