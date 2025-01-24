<?php

use Core\Database;
use Core\Page;
use Core\Request;

$tableName = 'trn_orders';
$module = 'kaosful';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database;

if(Request::isMethod('POST'))
{
    $data = isset($_POST[$tableName]) ? $_POST[$tableName] : [];
    $items = $_POST['items'];
    $data['total_items'] = count($items);
    $data['total_qty'] = array_sum(array_column($items, 'qty'));
    $data['total_value'] = str_replace(',','',$data['total_value']);
    $order = $db->insert('trn_orders', $data);

    foreach($items as $index => $item)
    {
        if($item['variant_id'] == '') unset($item['variant_id']);
        if($item['variant_2_id'] == '') unset($item['variant_2_id']);
        if($item['variant_3_id'] == '') unset($item['variant_3_id']);
        if($item['variant_4_id'] == '') unset($item['variant_4_id']);
        if($item['variant_5_id'] == '') unset($item['variant_5_id']);
        $item['order_id'] = $order->id;
        $item['order_amount'] = $item['price'] * $item['qty'];
        $db->insert('trn_order_items', $item);
    }

    set_flash_msg(['success'=>"Pesanan berhasil ditambahkan"]);

    header('location:'.routeTo('kaosful/orders/new'));
    die();
}

// page section
$title = 'Transaksi New Order';
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

Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");
Page::pushFoot("<script>var items = []</script>");
Page::pushFoot("<script src='".asset('assets/kaosful/js/new-order.js')."'></script>");
Page::pushFoot("<script>$('.select2insidemodal').select2({dropdownParent: $('.modal-body')});</script>");

Page::pushHook('create');

$db->query = "SELECT COUNT(*) as `counter` FROM trn_orders WHERE created_at LIKE '%".date('Y-m')."%'";
$counter = $db->exec('single')?->counter ?? 0;

$code = "INV" . date('Ym') . sprintf("%04d", $counter+1);

return view('kaosful/views/orders/new/create', compact('error_msg','old','tableName','code'));