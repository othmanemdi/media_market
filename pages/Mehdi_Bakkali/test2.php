<?php

ob_start();
// php
$title = "Test 2";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Test 2 page</h1>


<?php $content_html = ob_get_clean(); ?>