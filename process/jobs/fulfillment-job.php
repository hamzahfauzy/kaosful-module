<?php

use Core\Database;
use Core\Page;
use Core\Request;

// page section
$title = 'Edit Pemenuhan / Fulfillment Order';
$success_msg = get_flash_msg('success');
$error_msg   = get_flash_msg('error');

Page::setActive("kaosful.jobs.fulfillment");
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

$db = new Database;
$items = $db->all('trn_order_items', [
    'order_id' => $_GET['id']
]);

if(Request::isMethod('POST'))
{
    // print_r($_POST);die;
    foreach($_POST['completed'] as $id => $qty)
    {
        $item = $db->single('trn_order_items', [
            'id' => $id,
        ]);

        $time_done = $item->time_done ?? date('Y-m-d H:i:s');
        $time_done = $qty == 0 ? 'NULL' : $time_done;
        
        $db->update('trn_order_items',[
            'qty_done' => $qty,
            'time_done' => $time_done
        ], [
            'id' => $id,
        ]);
    }

    $checker = $db->exists('trn_order_items', [
        'time_done' => ['IS', 'NULL']
    ], [
        'order_id' => $_GET['id']
    ]);

    if(!$checker)
    {
        $db->query = "UPDATE trn_order_items SET qty_done = qty, time_done = NOW() WHERE order_id = $_GET[id]";
        $db->exec();
    }

    set_flash_msg(['success'=>"Data berhasil diupdate"]);

    header('location:'.routeTo('kaosful/jobs/fulfillment', ['id' => $_GET['id']]));
    die();
}

return view('kaosful/views/jobs/fulfillment-job', compact('items','success_msg','error_msg'));