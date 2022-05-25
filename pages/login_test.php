<?php

ob_start();
// php
$title = "Login test";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Login test</h1>


<?php $content_html = ob_get_clean(); ?>