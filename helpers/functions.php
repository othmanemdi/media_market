<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    die();
}

function _string(string $value): string
{
    return htmlspecialchars(strtolower(trim($value)));
}
