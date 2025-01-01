<?php

use Core\Database;

$db = new Database;
$order = $db->single('trn_orders', [
    'id' => $data->order_id
]);

// calculate

$items = (array) $db->all('trn_order_items', ['order_id' => $order->id]);
$data = [
    'total_items' => count($items),
    'total_qty'   => array_sum(array_column($items, 'qty')),
    'total_value'   => array_sum(array_column($items, 'order_amount')),
];

$db->update('trn_orders', $data, ['id' => $order->id]);

set_flash_msg(['success'=>"Item berhasil dihapus"]);

header('location:'.routeTo('kaosful/orders/new/view',['id' => $order->id]));
die();