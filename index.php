<?php

// var_dump(dirname(__DIR__) . DIRECTORY_SEPARATOR);
// die();

if (isset($_GET['page'])) {
    $get_page = htmlspecialchars(trim($_GET['page']));
} else {
    // echo "Error";
    // die();
    $get_page = "home";
}

$pages_exp = explode('/', $get_page);
$page_exp_count = count($pages_exp);
$admin = false;

if ($page_exp_count == 2 && $pages_exp[0] === "admin") {
    $page = $pages_exp[1];
    $admin = true;
    $directory = 'pages/admin/';
    $pages = scandir('pages/admin/');
} else {
    $page = $get_page;
    $pages = scandir('pages/');
    $directory = 'pages/';
}

// echo $page;
// die();

require_once "database/db.php";
require_once "helpers/functions.php";
$page_file = $page . ".php";

// $pages = $admin ? scandir('pages/admin/') : scandir('pages/');

if (in_array($page_file, $pages)) {
    require_once $directory . $page_file;
} else {
    require_once $directory . '404.php';
}

// echo $page_file;
// die();
echo $content_php ?? "";

?>
<!DOCTYPE html>
<html lang="en" dir="rtl" >
<?php if ($admin) : ?>

    <head>

        <?php require_once "pages/admin/body/head.php" ?>

        <?= $content_css ?? ""; ?>

        <?php require_once "pages/admin/body/script.php" ?>
    </head>

    <body>

        <?php require_once "pages/admin/body/nav.php" ?>

        <div class="container mb-5">

            <?php if (isset($_SESSION['flash'])) : ?>
                <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                    <div class="alert alert-<?= $type; ?> mt-3">
                        <?= $message; ?>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>


            <div class="row mt-5">
                <div class="col-md-3">
                    <?php require_once "pages/admin/body/sidebar.php" ?>
                </div>
                <div class="col">
                    <?= $content_html ?? "" ?>
                </div>
            </div>
        </div>


    <?php else : ?>

        <head>

            <?php require_once "pages/body/head.php" ?>

            <?= $content_css ?? ""; ?>

            <?php require_once "pages/body/script.php" ?>
        </head>

        <body>
            <?php require_once "pages/body/info.php" ?>
            <?php require_once "pages/body/header.php" ?>
            <?php require_once "pages/body/nav.php" ?>

            <div class="container mt-5">

                <?php if (isset($_SESSION['flash'])) : ?>
                    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                        <div class="alert alert-<?= $type; ?> mt-3">
                            <?= $message; ?>
                        </div>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif; ?>

                <?= $content_html ?? "" ?>
            </div>
        <?php endif ?>


        <?= $content_js ?? ""; ?>

        <?php if ($admin) : ?>
            <?php require_once "pages/admin/body/footer.php" ?>
        <?php else : ?>
            <?php require_once "pages/body/footer.php" ?>
        <?php endif ?>

        </body>

</html>