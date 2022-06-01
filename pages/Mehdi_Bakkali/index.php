<?php

ob_start();
// php
$title = "Test";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Test page</h1>


<?php $content_html = ob_get_clean(); ?>