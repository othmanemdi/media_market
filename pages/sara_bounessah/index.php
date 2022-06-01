<?php

ob_start();
// php
$title = "test";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>test page</h1>


<?php $content_html = ob_get_clean(); ?>