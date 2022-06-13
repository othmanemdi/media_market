<?php

ob_start();
// php
$title = "Stock";

$content_php = ob_get_clean();


ob_start(); ?>

<h3>Stock</h3>


<?php $content_html = ob_get_clean(); ?>