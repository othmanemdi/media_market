<nav class="bg-yahya  border-bottom border-warning  sticky-top  ">
  <div class=" container  ">
    <div class="d-flex flex-wrap">





      <div class="row">
      <div class="col-auto me-auto mb-2">
                <img src="images\logo\2x\Artboard 1_1@2x.png" alt="" height="80" class="mt-0">
 
            </div>



        <div class="col-auto me-auto mb-9">
          <ul class="nav justify-content-end ">
            <li class="nav-item">
              <a class="nav-link link-warning px-4 <?= $page == "home" ? 'text-danger fw-bold' : "" ?>" href="home">الرئيسية</a>
            </li>


            <li class="nav-item ">
              <a class="nav-link link-warning dropdown-toggle" href="#" id="navbarwarningDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                عن يحيى
                <ul class="dropdown-menu dropdown-menu-warning" aria-labelledby="navbarwarningDropdownMenuLink">
                  <a class="dropdown-item" href="vision">رؤيتي ورسالتي</a>
                  <a class="dropdown-item" href="experience">خبراتي ومؤهلاتي</a>
                  <a class="dropdown-item" href="histoire">القصة التي غيرت حياتي </a>
                  <a class="dropdown-item" href="complement"> شهادات أعتز بها </a>


                </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link link-warning dropdown-toggle" href="#" id="navbarwarningDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                مشروع العمر

                <ul class="dropdown-menu dropdown-menu-warning" aria-labelledby="navbarwarningDropdownMenuLink">
                  <a class="dropdown-item" href="femme">لربات البيوت</a>
                  <a class="dropdown-item" href="salarier"> للموظفين</a>
                  <a class="dropdown-item" href="chomage"> للعاطلين عن العمل</a>
                  <a class="dropdown-item" href="vente_directe"> لرواد البيع المباشر</a>

                </ul>
            </li>


            <li class="nav-item dropdown">
              <a class="nav-link link-warning dropdown-toggle" href="#" id="navbarwarningDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                شركة DXN
                <ul class="dropdown-menu dropdown-menu-warning" aria-labelledby="navbarwarningDropdownMenuLink">
                  <a class="dropdown-item" href="societe"> عن الشركة</a>
                  <a class="dropdown-item" href="store_dxn"> منتاجات DXN</a>
                  <a class="dropdown-item" href="success"> مقومات النجاح </a>
                  <a class="dropdown-item" href="e_comerce"> نضام العمل التسويقي</a>
                  <a class="dropdown-item" href="etape-travail"> طريقة العمل الإحترافية مع Dxn</a>
                  <a class="dropdown-item" href="pourquoi_dxn"> لماذا DXN اختيارك الصحيح?</a>
                </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link link-warning px-4 <?= $page == "store_dxn" ? 'text-danger fw-bold' : "" ?>" href="store_dxn">متجر</a>
            </li>

            <li class="nav-item">
              <a class="nav-link link-warning px-4 <?= $page == "devlopeur" ? 'text-danger fw-bold' : "" ?>" href="devlopeur">مبرمج الموقع</a>
            </li>
           

            <li class="nav-item">
              <a class="nav-link link-warning px-4 <?= $page == "album" ? 'text-danger fw-bold' : "" ?>" href="album">الصور والأحداث</a>
            </li>


            <?php if (isset($_SESSION['auth'])) : ?>

              <a href="logout" class="nav-link link-warning px-4 "> <?= ucfirst($_SESSION['auth']->prenom) ?> <?= ucfirst($_SESSION['auth']->email) ?></a>

            <?php else : ?>

              <a href="contact" class="nav-link link-warning px-4 <?= $page === 'contact' ? 'text-danger  fw-bold' : '' ?>"> تواصل معنا</a>



            <?php endif; ?>
          </ul>

        </div>
      </div>



    </div>



  </div>


  </div>
  
</nav>





