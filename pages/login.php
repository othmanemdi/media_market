<?php

ob_start();
// php
$title = "Login";

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $input_email = htmlspecialchars(trim($_POST['email']));
        $input_password = htmlspecialchars(trim($_POST['password']));

        $req = $pdo->prepare('SELECT * FROM users WHERE email = :email and activated = 1 LIMIT 1');
        $req->execute(['email' => $input_email]);
        $user = $req->fetch();

        // echo '<pre>';
        // print_r(password_verify(1234567, $user->password));
        // echo '</pre>';

        // exit();
        if (password_verify($input_password, $user->password)) {
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
            header('Location: dashboard');
        } else {
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
            header('Location: login');
        }
    }
    exit();
}
$content_php = ob_get_clean();

ob_start(); ?>

<div class="row justify-content-md-center ">
    <div class="col-6">
        <div class="bg-light p-5 rounded-pilla rounded-3">
            <h3 class="text-center mb-4">سجل حسابك </h3>
            <h5 class="text-center">دخول</h5>

            <form method="post" autocomplete="off" class="row g-3">
                <div class="form-group">
                    <label class="form-label" for="email">البريد الالكتروني: (<span class="text-kitea">*</span>)</label>

                    <input name="email" type="email" class="form-control" id="email" require placeholder="أدخل بريدك الاكتروني !">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">الرمز السري: (<span class="text-kitea">*</span>)</label>

                    <input name="password" type="password" class="form-control" id="password" require placeholder="ادخل رمزك السري  !">
                </div>


                <div class="d-flex  mb-3">
                    <div class="me-auto p-2 ">
                        <button type="submit" name="login" class="btn btn-warning text-white">دخول</button>
                    </div>
                    <div class="p-2 ">
                        <a href="forgotpassword" class="text-kitea fw-bold">نسيت الرمز السري?</a>
                    </div>
                </div>

            </form>

            <h5 class="text-center mt-4">مستخذم جديد</h5>
            <hr>
            <p class="text-center">
                لتسجيلك حساب معنا مميزات عدة : متابعة سريعة للمستجدات, متابعة طلبياتك, والكثير.
            </p>
            <div class="d-flex justify-content-center">
                <a href="register" class="btn btn-warning text-white mt-4 text-center">تسجيل حساب</a>
            </div>

        </div>
    </div>
</div>

<?php $content_html = ob_get_clean(); ?>