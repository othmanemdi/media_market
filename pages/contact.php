<?php

ob_start();
// php
$title = "Contactez-nous";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Contactez-nous</h1>


<?php $content_html = ob_get_clean(); ?>