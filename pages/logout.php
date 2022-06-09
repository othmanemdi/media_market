<?php

session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['info'] = 'Vous êtes maintenant déconnecté';
header('Location: login');
