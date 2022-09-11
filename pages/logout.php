<?php

session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['info'] = 'غير متصل';
header('Location: login');
