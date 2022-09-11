<?php

ob_start();
// php
$errors = [];
// $errors = array();

if (isset($_POST['ajt_info'])) {
    if (empty($_POST['prenom']) or !preg_match('/^[a-zA-Z]+$/', $_POST['prenom']) or strlen($_POST['prenom']) < 3) {
        // $errors["prenom"] = "Votre prénome n'est pas valide";
        $errors["prenom"] = "";
        if (empty($_POST['prenom'])) {
            $errors["prenom"] .= "المرجو كتابة اسمك الشخصي ";
        } else {

            if (!preg_match('/^[a-zA-Z]+$/', $_POST['prenom'])) {
                $errors["prenom"] .= "المرجو كتابة الحروف الهجائية ";
            }
            if (strlen($_POST['prenom']) < 3) {
                $errors["prenom"] .= "المرجو كتابة اكثر من 3 احرف ";
            }
        }
        $prenom_class_input = "is-invalid";
        $prenom_class_feedback = "invalid-feedback";
    } else {
        $prenom_class_input = "is-valid";
        $prenom_class_feedback = "valid-feedback";
    }


    if (empty($_POST['nom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['nom'])) {
        $errors["nom"] = "Votre nom n'est pas valide";
        $nom_class_input = "is-invalid";
        $nom_class_feedback = "invalid-feedback";
    } else {
        $nom_class_input = "is-valid";
        $nom_class_feedback = "valid-feedback";
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Votre email n'est pas valide";
        $email_class_input = "is-invalid";
        $email_class_feedback = "invalid-feedback";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();


        if ($user) {
            $errors['email'] = ' هذا البريد الالكتروني مستخدم'   ;
            $email_class_input = "is-invalid";
            $email_class_feedback = "invalid-feedback";
        } else {
            $email_class_input = "is-valid";
            $email_class_feedback = "valid-feedback";
        }
    }

   








    

    if (empty($errors)) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $req = $pdo->prepare("INSERT INTO users SET prenom = ?, nom = ?, password = ?, email = ? , role_id = ?");
        $req->execute([$_POST['prenom'], $_POST['nom'], $password, $_POST['email'], 3]);
        $user_id = $pdo->lastInsertId();

        $_SESSION['flash']['success'] = 'Bien enregister';
        header('Location: home');
        exit();
    }
}



$title = "contactez-nous";

$content_php = ob_get_clean();

ob_start(); ?>


<div class="texte-center mt-5 me-5 ">
                      <img src="images\logo\WhatsApp Image 2022-07-26 at 15.04.43.jpeg" class="rounded mx-auto d-block" height=600  alt="...">
                   </div>
          
                   <div class="row g-0"> 

                   <div class="col-sm-6 col-md-2"></div>
                   <div class="col-sm-6 col-md-8">
                      <p class="lh-lg   texte-justify-content-md-center mt-5 me-5  "> 
                        
                     أنت  بأول الطريق؟ قطعت نصف الطريق؟ عندك أهداف كبيرة؟ وعندك طاقة عالية؟
                     <br>

لكن تحس انك غير راضي بمكانك اليوم؟ أو عندك التزامات كثيرة بحياتك، و غير قادر على ادارتها؟ 

​<br>

لكن انت تعرف ومتأكد انه لديك الامكانيات و الطاقة، و تريد الوصول لنتائج  مرضية لك...

​<br>

مرحبا، أنا يحيى،  أحب مساعدة الأشخاص الذين يعملون على تطوير أنفسهم ، وانت في  المكان الصحيح!

 
<br>
أولا  أشكرك على شجاعتك، فتحديدك للمشكلة هو نصف الحل، و وجودك هنا هو دليل على انك شخص غير عادي ومهتم بتطوير نفسك.

​<br>

​تانيا  أطمئنك، انت لست لوحدك،وهذه قصتي،

<br>
<br>
 
<span class="fw-bold  text-decoration-underline " >   معنا تستطيع::</span>
<br>
*اكتشاف أهدافك،  
<br>
*وضع خطط مستقبلية واضحة وملهمة
<br>
*ترتيب الأولويات  
<br>
*زيادة تركيزك وتحسين إنتاجيتك
<br>
*وضع استراتيجيات للعمل بشكل  متطور
<br>
*كسر حاجز الخوف و زيادة الثقة بالنفس
<br>
*تحسين طرق التعبير عن الذات والتواصل مع الآخرين
<br>
​
اذا كنت تريد رحلة جديدة بحياتك وتخرج من دائرة الراحة،  سأطلب منك تعبئة المعلومات التالية  لأتواصل معك شخصياً .

</div>






<div class="row justify-content-md-center">
    <div class="col-8">
        <div class="bg-light p-5 rounded-pilla rounded-3">
           
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger shadow mb-4">
                    <h5>
                        <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#121331,secondary:#ed1c24" stroke="75" scale="40" style="width:50px;height:50px">
                        </lord-icon>
                        المرجو ملء الاستمارة بشكل صحيح
                    </h5>

                    <ul class="list-group list-group-flush">
                        <?php foreach ($errors as $key => $e) : ?>
                            <li class="list-group-item bg-transparent">
                                <b><?= ucfirst($key) ?></b> - <?= $e ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form method="post" autocomplete="off">


                 <div class="row g-0"> 

                     <div class="col-sm-6 col-md-6">
                           <div class="form-group mb-3">
                           <label class="form-label" for="prenom">الاسم الشخصي:</label>

                         <input name="prenom" type="text" class="form-control <?= $prenom_class_input ?? "" ?>" id="prenom" placeholder="Veuillez saisir votre prénom SVP !" value="<?= $_POST['prenom'] ?? "" ?>">

                                   <div class="<?= $prenom_class_feedback ?? "" ?> fw-bold">
                             <?= $errors['prenom'] ?? "" ?>
                    </div>


                    <div class="form-group mb-3 ">
                    <label class="form-label" for="email">البريد الاكتروني:</label>

                    <input name="email" type="email" class="form-control <?= $email_class_input ?? "" ?>" id="email" placeholder="Veuillez saisir votre adresse mail SVP !" value="<?= $_POST['email'] ?? "" ?>">

                    <div class="<?= $email_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['email'] ?? "" ?>
                    </div>
                </div>

                </div>
                     </div>
                     <div class="col-sm-6 col-md-6">

                <div class="form-group  me-3 ">
                    <label class="form-label" for="nom">الاسم العائلي:</label>

                    <input name="nom" type="text" class="form-control <?= $nom_class_input ?? "" ?>" id="nom" placeholder="Veuillez saisir votre nom SVP !" value="<?= $_POST['nom'] ?? "" ?>">

                    <div class="<?= $nom_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['nom'] ?? "" ?>
                    </div>
                </div>

                <div class="form-group mb-3 me-3">
                    <label class="form-label" for="email">البطاقة الوطنية :</label>

                    <input name="CIN" type="texte" class="form-control <?= $telephone_class_input ?? "" ?>" id="CIN" placeholder="المرجو ادخال رقم هويتك !" value="<?= $_POST['telephone'] ?? "" ?>">

                    <div class="<?= $cin_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['cin'] ?? "" ?>
                    </div>
                </div>

                     </div>

                <div class="form-group mb-3 me-3">
                    <label class="form-label" for="email">الهاتف :</label>

                    <input name="telephpne" type="numbre" class="form-control <?= $telephone_class_input ?? "" ?>" id="telephone" placeholder="المرجو ادخال رقم هاتفك !" value="<?= $_POST['telephone'] ?? "" ?>">

                    <div class="<?= $telephone_class_feedback ?? "" ?> fw-bold">
                        <?= $errors['telephone'] ?? "" ?>
                    </div>
                </div>

                     </div>


                    


                <a href="thanx_page" name="ajt_info" class="btn btn-warning text-white">ارسال </a>
                
            </form>
        </div>
    </div>

</div>
<?php $content_html = ob_get_clean(); ?>