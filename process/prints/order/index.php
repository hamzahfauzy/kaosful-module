<?php

use Core\Database;
use Core\Page;

$db = new Database;
$tableName = 'trn_orders';
$module = 'kaosful';

// page section
$title = 'Cetak Order Detail';
Page::setActive("kaosful.prints.order");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => '#',
        'title' => 'Cetak'
    ],
    [
        'title' => $title
    ]
]);
Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script>$('.select2').select2();</script>");

return view('kaosful/views/prints/order/index');