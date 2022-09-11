<?php

ob_start();
// php
$title = "Thanx";

$content_php = ob_get_clean();


ob_start(); ?>

<h3>شكرا لكم</h3>


<div class="alert alert-success h2 p-4" role="alert">
    <i class="fa-solid fa-circle-check text-success"></i> تم قبول طلبكم
</div>

<p>
    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur fugit doloribus eveniet possimus
    dolores, rerum pariatur maxime voluptatem odit? Quos ducimus eius quam quod alias numquam amet velit modi.
    Id.
    Nihil eius assumenda officiis? Possimus ex ratione et voluptatem autem! Magni, delectus. Ad consequuntur
    omnis porro hic itaque reiciendis at debitis dolor eligendi natus, delectus dolore incidunt ut ea eos?
</p>

<a href="store_dxn" class="btn btn-outline-danger btn-lg mt-2">
    <i class="fa-solid fa-circle-chevron-left"></i>
   العودة للمتجر</a>

<?php $content_html = ob_get_clean(); ?>