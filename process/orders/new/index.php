<?php

use Core\Page;
use Core\Route;
use Modules\Crud\Libraries\Repositories\CrudRepository;

Route::additional_allowed_routes([
    'route_path' => '!crud/create?table=trn_orders',
]);
Route::additional_allowed_routes([
    'route_path' => '!crud/edit?table=trn_orders',
]);
Route::additional_allowed_routes([
    'route_path' => '!crud/delete?table=trn_orders',
]);

// init table fields
$tableName  = 'trn_orders';
$fields     = [
    'order_number' => [
        'label' => 'No. Order',
        'type' => 'text'
    ],
    'tgl_order' => [
        'label' => 'Tgl. Order',
        'type' => 'text',
        'search' => [
            'trn_orders.order_date',
            'trn_orders.order_done_date',
        ]
    ],
    'customer' => [
        'label' => 'Customer',
        'type' => 'text',
        'search' => [
            'mst_customers.name',
            'mst_order_types.name'
        ]
    ],
    'total_item' => [
        'label' => 'Total Items / Qty',
        'type' => 'text',
        'search' => [
            'trn_orders.total_items',
            'trn_orders.total_qty'
        ]
    ],
    'status' => [
        'label' => 'Status',
        'type' => 'text',
        'search' => 'trn_orders.status',
    ]
];
$module = 'kaosful';
$success_msg = get_flash_msg('success');
$error_msg   = get_flash_msg('error');

// page section
$title = 'New Order';
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
        'title' => $title
    ]
]);

Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

Page::pushHook('index');

// get data
$crudRepository = new CrudRepository($tableName);
$crudRepository->setModule($module);

if(isset($_GET['draw']))
{
    return $crudRepository->dataTable($fields);
}

return view('crud/views/index', compact('fields', 'tableName', 'success_msg', 'error_msg', 'crudRepository'));