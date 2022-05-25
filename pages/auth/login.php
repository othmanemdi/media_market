<?php

ob_start();
// php
$title = "Login";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Login page</h1>


<?php $content_html = ob_get_clean(); ?>