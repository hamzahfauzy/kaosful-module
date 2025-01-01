<?php

use Core\Event;
use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = 'trn_orders';
$id         = $_GET['id'];
$module = 'kaosful';
$fields     = [
    'order_number' => [
        'label' => 'No. Order',
        'type' => 'text'
    ],
    'order_type_id' => [
        'label' => 'Jenis Order',
        'type' => 'options-obj:mst_order_types,id,name'
    ],
    'order_date' => [
        'label' => 'Tgl. Order',
        'type' => 'date'
    ],
    'order_done_date' => [
        'label' => 'Tgl. Estimasi Selesai',
        'type' => 'date'
    ],
    'customer_id' => [
        'label' => 'Customer',
        'type' => 'options-obj:mst_customers,id,name'
    ],
    'employee_id' => [
        'label' => 'Karyawan',
        'type' => 'options-obj:mst_employees,id,name'
    ],
    'description' => [
        'label' => 'Deskripsi',
        'type' => 'textarea',
        'attr' => [
            'class' => 'form-control select2-search__field'
        ]
    ],
];
$title      = "Edit New Order";
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');

$crudRepository = new CrudRepository($tableName);
$crudRepository->setModule($module);

if(Request::isMethod('POST'))
{
    $data = isset($_POST[$tableName]) ? $_POST[$tableName] : [];

    $data = $crudRepository->update($data, [
        'id' => $id
    ]);

    set_flash_msg(['success'=>"Data New Order berhasil diupdate"]);

    header('location:'.routeTo('kaosful/orders/new'));
    die();
}

$data = $crudRepository->find([
    'id' => $id
]);

// page section
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

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<script src="https://cdn.tiny.cloud/1/rsb9a1wqmvtlmij61ssaqj3ttq18xdwmyt7jg23sg1ion6kn/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>');
Page::pushHead("<script>
tinymce.init({
    selector: 'textarea:not(.select2-search__field)',
    relative_urls : false,
  remove_script_host : false,
  convert_urls : true,
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
});
</script>");
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;}.select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

return view('kaosful/views/orders/new/edit', compact('fields', 'tableName', 'data', 'error_msg', 'old'));