<?php

ob_start();
// php
$title = "Register test";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Register test</h1>


<?php $content_html = ob_get_clean(); ?>