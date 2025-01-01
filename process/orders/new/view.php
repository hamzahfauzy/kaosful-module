<?php

use Core\Database;
use Core\Page;
use Core\Request;

$db = new Database;
$tableName = 'trn_orders';
$module = 'kaosful';
$error_msg  = get_flash_msg('error');
$success_msg  = get_flash_msg('success');
$old        = get_flash_msg('old');

$data = $db->single('trn_orders', ['id' => $_GET['id']]);

if(Request::isMethod('POST'))
{
    $items = $_POST['items'];

    foreach($items as $index => $item)
    {
        if($item['variant_id'] == '') unset($item['variant_id']);
        if($item['variant_2_id'] == '') unset($item['variant_2_id']);
        if($item['variant_3_id'] == '') unset($item['variant_3_id']);
        if($item['variant_4_id'] == '') unset($item['variant_4_id']);
        if($item['variant_5_id'] == '') unset($item['variant_5_id']);
        $item['order_id'] = $data->id;
        $item['order_amount'] = $item['price'] * $item['qty'];
        $db->insert('trn_order_items', $item);
    }

    $items = (array) $db->all('trn_order_items', ['order_id' => $data->id]);
    $udpateData = [
        'total_items' => count($items),
        'total_qty'   => array_sum(array_column($items, 'qty')),
        'total_value'   => array_sum(array_column($items, 'order_amount')),
    ];

    $db->update('trn_orders', $udpateData, ['id' => $data->id]);

    set_flash_msg(['success'=>"Pesanan berhasil diupdate"]);

    header('location:'.routeTo('kaosful/orders/new/view', ['id' => $data->id]));
    die();
}

$data->customer = $db->single('mst_customers', ['id' => $data->customer_id]);
$data->order_type = $db->single('mst_order_types', ['id' => $data->order_type_id]);
$data->employee = $db->single('mst_employees', ['id' => $data->employee_id]);
$data->items = $db->all('trn_order_items', ['order_id' => $data->id]);

$items = [];
foreach($data->items as $index => $item)
{
    $items[] = [
        'key' => $index+1,
        'name' => $item->name,
        'qty' => (int) $item->qty,
        'price' => (int) $item->price,
        'total_price' => (int) $item->order_amount,
        'unit' => $item->unit,
        'category' => $item->category_id,
        'size' => $item->size_id,
        'product' => $item->product_id,
        'pattern' => $item->pattern_id,
        'collar' => $item->collar_id,
        'variant' => $item->variant_id,
        'variant_2' => $item->variant_2_id,
        'variant_3' => $item->variant_3_id,
        'variant_4' => $item->variant_4_id,
        'variant_5' => $item->variant_5_id,
    ];
}

// page section
$title = 'New Order Detail';
Page::setActive("kaosful.orders.new");
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
        'url' => routeTo('kaosful/orders/new'),
        'title' => 'New Order'
    ],
    [
        'title' => $title
    ]
]);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script>var items = ".json_encode($items)."</script>");
Page::pushFoot("<script src='".asset('assets/kaosful/js/new-order.js')."'></script>");
Page::pushFoot("<script>$('.select2insidemodal').select2({dropdownParent: $('.modal-body')});</script>");

return view('kaosful/views/orders/new/view', compact('data','error_msg','success_msg','old','tableName'));