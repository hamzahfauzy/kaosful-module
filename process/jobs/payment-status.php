<?php

use Core\Page;
use Core\Route;
use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = 'trn_payments';
$table      = tableFields($tableName);
$fields     = $table->getFields();
$module     = $table->getModule();
$success_msg = get_flash_msg('success');
$error_msg   = get_flash_msg('error');

Route::additional_allowed_routes([
    'route_path' => '!crud/create?table='.$tableName,
]);
Route::additional_allowed_routes([
    'route_path' => '!crud/edit?table='.$tableName,
]);
Route::additional_allowed_routes([
    'route_path' => '!crud/delete?table='.$tableName,
]);

// page section
$title = 'Update Status Pembayaran';
Page::setActive("kaosful.jobs.payment_status");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => $tableName]),
        'title' => $title
    ],
    [
        'title' => 'Index'
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