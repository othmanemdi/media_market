<?php

ob_start();
//php
$title = "Home";

$content_php = ob_get_clean();


ob_start(); ?>
<div class="container">


<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <a href="vente_directe" >  <img src="images\CAROUSEL\Artboard 1.jpg"class="d-block w-100" ></a>
    
        
      <div class="carousel-caption d-none d-md-block">
    
       
      </div>
    </div>
    <div class="carousel-item">
      <img src="images\CAROUSEL\young-family-on-vacation-have-lot-of-fun.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>:</h5>
        <p>:</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images\CAROUSEL\close-up-of-sportive-man-jogging-in-field-at-sunrise.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>:</h5>
        <p>:</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden"></span>
  </button>
</div>


 















<div class="row g-0">

  <div class="col-sm-6 col-md-2"></div>
  <div class="col-sm-6 col-md-8">


  <div class="card  mb-5 mt-5 me-5" style="text-align: center;" >
  <div class="card-header fw-bolder text-light bg-warning mb-3" >مشروع الحياة لضمان مستقبلك  </div>
  <div class="card-body">
    <h5 class="card-title ">نساعدك من الألف الى الياء لتبدأ العمل على تحقيق أهداف</h5>
    <p class="card-text">في الوقت الراهن والظروف الحالية والتأزم الاقتصادي أصبح من الملح تعدد مصادر دخلك في ضل وجود المشاريع الذكية دون رأس مال أو شهادات.</p>
    <div class="card-footer bg-transparent border-warning">اذا كنت تحب البدء برحلة جديدة بحياتك وتخرج من دائرة الراحة
<a class="nav-link link-primary center text-decoration-underline px-2 <?= $page == "contact" ? '" fw-bold' : "" ?>" href="contact">احجز جلسة استشارية مع يحيى</a>

    </div>
 
  </div>


  </div>



















    
  <div class="col-sm-6 col-md-2 "></div>

</div>
<div class="row shadow mb-3">
  <div class="col-lg-3 col-md-4  ">
    <div class="card mb-3"style="text-align: center;">
    <li class="list-inline-item text-yahya-hover ">
    <i class="text-centre px-5 fa-solid fa-person-dress  text-warning fa-4x mt-3"></i>
                
            </li>



     
      <div class="card-body" >
        <h5 class="card-title texte-warning "style="margin-top: 0.25em;">لربات البيوت</h5>
        <p class="card-text ">تستحقين ان تكوني رائدة أعمال 

و صاحبة مكانة في المجتمع

إذا كنت جادة وطموحة وتبحثين عن

فرصة حقيقية لتحقيق دخل جيد...</p>
        <a href="#" class="btn btn-warning center">انضمي الينا</a>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-4">
    <div class="card mb-3"style="text-align: center;">
    <li class="list-inline-item text-yahya-hover ">
                <i class=" text-centre px-5 fa-solid fa-user-tie  text-warning fa-4x mt-3"   style=" fs-3  fw-bold : " ></i>
                
            </li>
      
      <div class="card-body">
        <h5 class="card-title-centre texte-warning" style="margin-top: 0.25em;">للموظفين</h5>
        <p class="card-text">


لا ضرر أبدأ من خلق مصادر دخل إضافية تعمل كبديل لمصدر دخلك الرئيسي في الظروف الصعبة ، وكلما بدأ الشخص مبكرا في التخطيط المالي كان ذلك أفضل.</p>
        <a href="#" class="btn btn-warning center texte">انضم الينا</a>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-4">
    <div class="card mb-3"style="text-align: center;">
    <li class="list-inline-item text-yahya-hover ">

    <i class="fa-solid fa-user-group   text-warning fa-4x mt-3 "></i>
                
                
            </li>
  
      <div class="card-body">
        <h5 class="card-title texte-warning" style="margin-top: 0.25em;">للعاطلين عن العمل</h5>
        <p class="card-text-centre">
      

       المشاريع الذكية هي أحد الحلول الناجعة للمساهمة في القضاء على البطالة من خلال تأمين فرص عمل  دون الحاجة إلى استثمار مالي أو مؤهلات علمية وشهادات خبرة.
.</p>
        <a href="#" class="btn btn-warning  ">انضم الينا</a>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-4">
    <div class="card mb-3"style="text-align: center;">
    <li class="list-inline-item text-yahya-hover ">
    <i class=" text-centre px-5 fa-solid fa-comments-dollar  text-warning fa-4x mt-3"></i>
</li>
      <div class="card-body">
        <h5 class="card-title texte-center" style="margin-top: 0.25em;">رواد البيع المباشر</h5>
        <p class="card-text">
    يعد البيع المباشر فرصة للجميع و أفضل صناعة للمستقبل في ظل التحول الرقمي.......</p>
        <a href="#" class="btn btn-warning texte-white">انضم الينا</a>
      </div>
    </div>

  </div>

</div>
</div>

</div>

<div class=" p-3 mt-3">

<div class="row g-0  mt-3">


<div class="col " style="text-align: center;">
<img src="images\logo\1x\Asset 1.png" class="rounded-circle shadow  me-5 " height="200"  alt="...">

  
    <div class=" mt-5">
      

<p class="lh-lg">
أنا يحيى اعبيدو رائد أعمال وخبير في التدريب والتسويق، مقاول وصاحب مشاريع ذاتية،وقعت بحب المعرفة المالية وأسست فريق الرواد الناجحين.
يسعدني أن أقدم لك هذا المشروع الذكي

الذي من الممكن أن يغير حياتك بإذن الله كما غير حياتي وحياة الملايين ..

لماذا نقول مشروع ذكي؟ لأنه وببساطة أي رائد أعمال يعرف أن المشاريع تحتاج لأربعة أمور :

(رأس مال وخبرة وجهد ووقت) ، لكن مع هذا المشروع الذكي انت تحتاج فقط بعض الجهد والوقت ، لذلك ليس هناك أي هامش مخاطرة لعدم وجود رأسمال .

لن أتكلم بلغة نظرية وأحلام وردية ، سأتكلم عن واقع مجرب أعيشه أنا شخصياً مع هذا المشروع التجاري الذكي منذ 3 سنوات فأنا بفضل الله صاحب خبرة طويلة في هذا المجال 
ولدي فريق وصل عددهم الى عشرات الآلاف وقد ساعدت الآلاف  في العديد من الدول لتغيير حياتهم نحو الأفضل.
<br>

فإذا كنت تبحث عن فرصة حقيقية تحقق من خلالها طموحاتك المالية تابع الفيديو على اليسار لمدة (8 دقائق)
<br>
<a href="#" class="btn btn-primary text-warning">مشاهدة الفيديو</a>
<br>
وإذا قررت أن تنضم لهذا المشروع وتحقق أهدافك المالية ، دعنا نبارك لك أولا ، ثم يسعدنا انضمامك لفريقنا من

خلال الانضمام عبر الرابط المباشر 

<br>
<a href="#" >https://eworld.dxn2u.com/s/accreg/en/819944037</a>
<br>

 بعد مشاهدة

طريقة التسجيل في 
<br>
<a href="#" >(فيديو تسجيل العضوية ) </a>
<br>
لاتتردد وكن مستثمرا ذكيا واحجز مكانك مع رواد البيع المباشر..

<br>
للمزيذ من المعلومات .

<a  href="https://wa.me/qr/6Q43NFZRNMN7P1" >تواصل معنا </a>
</p>
</div>
</div>



</div>






















<?php $content_html = ob_get_clean(); ?>