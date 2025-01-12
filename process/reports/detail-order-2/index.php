<?php

use Core\Database;
use Core\Page;

$db = new Database;
$tableName = 'trn_orders';
$module = 'kaosful';
$order = null;

if(isset($_GET['order_number']) && !empty($_GET['order_number']))
{
    $order_number = $_GET['order_number'];
    $order = $db->single($tableName, [
        'order_number' => $order_number
    ]);

    $order->customer = $db->single('mst_customers', ['id' => $order->customer_id]);
    $order->employee = $db->single('mst_employees', ['id' => $order->employee_id]);
    $order->order_type = $db->single('mst_order_types', ['id' => $order->order_type_id]);

    $order->items = $db->all('trn_order_items', ['order_id' => $order->id]);
    $names = $db->all('trn_order_names', ['order_id' => $order->id]);

    $names = array_map(function($name) use ($db){
        $name->item = $db->single('trn_order_items', ['id' => $name->order_item_id]);
        return $name;
    }, $names);

    $order->names = $names;

    $db->query = "SELECT trn_payments.*, mst_banks.name bank_name FROM trn_payments LEFT JOIN mst_banks ON mst_banks.id = trn_payments.bank_id WHERE trn_payments.order_id = $order->id";
    $order->payments = $db->exec('all');
}

$orders = $db->all('trn_orders', [
    'status' => ['<>', 'CANCEL']
]);

$orderOptions = ['- Pilih -'=>0];
foreach($orders as $_order)
{
    $orderOptions[$_order->order_number] = $_order->order_number;
}

// page section
$title = 'Laporan Detail Order 2';
Page::setActive("kaosful.reports.detail_order_2");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => '#',
        'title' => 'Laporan'
    ],
    [
        'title' => $title
    ]
]);
Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script>$('.select2').select2();</script>");

return view('kaosful/views/reports/detail-order-2/index', compact('order', 'orderOptions'));