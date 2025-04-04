<?php

use Core\Database;

$fields['code']['attr']['readonly'] = 'readonly';

$db = new Database;
$db->query = "SELECT * FROM trn_orders WHERE status = 'APPROVE' AND total_value <> COALESCE(total_payment, 0)";
$orders = $db->exec('all');
$orderOptions = [];
foreach($orders as $order)
{
    $orderOptions[$order->order_number] = $order->id;
}

$fields['order_id']['type'] = 'options:'.json_encode($orderOptions);
$fields['code']['attr'] = [
    'readonly' => 'readonly',
];

unset($fields['customer_name']);

return $fields;