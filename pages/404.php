<?php

ob_start();
// php
$title = "404";

$content_php = ob_get_clean();


ob_start(); ?>

<h3>404 page</h3>


<?php $content_html = ob_get_clean(); ?>