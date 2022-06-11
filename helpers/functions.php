<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function dd(array $array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    die();
}
