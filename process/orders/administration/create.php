<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Modules\Default\Libraries\Sdk\Media;

$db = new Database;
$tableName = 'trn_orders';
$module = 'kaosful';
$error_msg  = get_flash_msg('error');
$success_msg  = get_flash_msg('success');
$old        = get_flash_msg('old');

if(Request::isMethod('POST'))
{
    $data = isset($_POST['items']) ? $_POST['items'] : [];
    foreach($data as $index => $item)
    {
        $item['order_id'] = $_GET['id'];
        $db->insert('trn_order_names', $item);
    }

    if(isset($_FILES['pic_1']) && !empty($_FILES['pic_1']['name']))
    {
        $file = Media::singleUpload($_FILES['pic_1']);
        $db->update('trn_orders', [
            'pic_1' => $file->name
        ], [
            'id' => $_GET['id']
        ]);
    }
    
    if(isset($_FILES['pic_2']) && !empty($_FILES['pic_2']['name']))
    {
        $file = Media::singleUpload($_FILES['pic_2']);
        $db->update('trn_orders', [
            'pic_2' => $file->name
        ], [
            'id' => $_GET['id']
        ]);
    }

    set_flash_msg(['success'=>"Administrasi berhasil ditambahkan"]);

    header('location:'.routeTo('kaosful/orders/administration'));
    die();
}

$data = $db->single('trn_orders', ['id' => $_GET['id']]);
$data->customer = $db->single('mst_customers', ['id' => $data->customer_id]);
$data->order_type = $db->single('mst_order_types', ['id' => $data->order_type_id]);
$data->employee = $db->single('mst_employees', ['id' => $data->employee_id]);

$data->names = $db->all('trn_order_names', ['order_id' => $data->id]);

$items = [];
foreach($data->names as $index => $name)
{
    $item = $db->single('trn_order_items',['id' => $name->order_item_id]);
    $name->item = $item;
    $items[] = [
        'key' => $index+1,
        'item' => $item->name,
        'name' => $name->name,
        'number_description' => $name->number_description,
        'description' => $name->description,
    ];
}

// page section
$title = 'Form Foto & Administrasi Order';
Page::setActive("kaosful.orders.administration");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => '#',
        'title' => 'Data Order'
    ],
    [
        'url' => routeTo('kaosful/orders/administration'),
        'title' => 'Foto & Administrasi Order'
    ],
    [
        'title' => $title
    ]
]);


Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');

Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");
Page::pushFoot("<script>var items = ".json_encode($items)."</script>");
Page::pushFoot("<script src='".asset('assets/kaosful/js/order-administration.js')."'></script>");

return view('kaosful/views/orders/administration/create', compact('data','error_msg','success_msg','old','tableName'));