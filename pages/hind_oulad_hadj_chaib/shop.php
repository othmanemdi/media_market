<?php

ob_start();
// php
$title = "Shop";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Shop page</h1>


<?php $content_html = ob_get_clean(); ?>