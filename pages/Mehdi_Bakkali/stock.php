<?php

ob_start();
// php
$title = "Stock";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Stock page</h1>


<?php $content_html = ob_get_clean(); ?>