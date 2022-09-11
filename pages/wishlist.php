<?php

 ob_start();
 //php
 $title = "wishlist";

 $content_php = ob_get_clean();






 ob_start(); ?>



<div class="card mb-3"style="text-align: center;">
    <li class="list-inline-item text-yahya-hover ">
    <i class=" text-centre px-5 fa-solid fa-heart  text-warning fa-4x mt-3"></i>
</li>
      <div class="card-body">
        <h5 class="card-title texte-center" style="margin-top: 0.25em;"> Wishlist is empty. </h5>
        <p class="card-text">ليس لديك أي منتجات في قائمة الرغبات حتى الآن. <br> سوف تجد الكثير من المنتجات الشيقة على صفحة "التسوق".						</div>
</p>
<p class="return-to-shop">
                            
            
                            <a class="btn btn-warning" href="store_dxn">
							Return to shop						</a>
</p>
      </div>
    </div>



















<?php $content_html = ob_get_clean(); ?>