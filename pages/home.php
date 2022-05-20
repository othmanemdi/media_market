<?php

ob_start();
// php
$title = "Home";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Home page</h1>


<?php $content_html = ob_get_clean(); ?>