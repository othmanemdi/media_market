<?php

ob_start();
// php
$title = "Register";

$content_php = ob_get_clean();


ob_start(); ?>

<h1>Register page</h1>


<?php $content_html = ob_get_clean(); ?>